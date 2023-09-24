// Bailey
const alphabet = 'abcdefghijklmnopqrstuvwxyz';

// COMPILER

class Move {
    /**
     * @type {pieceType}
     */
    pieceType = null;
    piece = null;
    dest = null;
    taking = null;
    /**
     * @type {Array}
     */
    operations = [];
}

const PieceType = {
    pawn: "P",
    rook: "R", //
    king: "K", //
    knight: "N",
    queen: "Q", //
    bishop: "B", //
}

/**
 * @param {string} classes 
 * @returns {number}
 */
const rank = (classes) => parseInt(classes.match(/rank-\d+/g)[0].substring(5));
/**
 * @param {string} classes 
 * @returns {string}
 */
const file = (classes) => classes.match(/file-[a-z]+/g)[0].substring(5); 
/**
 * @param {String} a classes of first object to compare
 * @param {String} b classes of second object to compare
 * @param {String} type either "rank" or "file"
 */
const compareClass = (type,a,b) => {
    const rexp = new RegExp(`${type}-`)
    return a[a.search(rexp) + 5] == b[b.search(rexp) + 5] 
};
/**
 * @param cell jQuery object of a cell on the board.
 * @param {string} file 
 * @param {number} rank 
 * @returns Whether the given cell matches the entered file and rank.
 */
const isAt = (cell, file = "-1", rank = -1) => {
    return  (file == "-1" || cell.hasClass(`file-${file}`)) 
            &&
            (rank == -1 || cell.parent().hasClass(`rank-${rank}`)) 
};
/**
 * @param {string} file 
 * @param {number} rank 
 */
const isPieceAt = (file, rank, board) => board.find(`.S${file}${rank} > .piece`).length != 0;

/**
 * Returns data about a move on the given board given a chess noation move string.
 * @param {String} str The chess notation move
 * @returns {Move}
 */
function compile_move(str, white, board) {
    /** @type {Move} */
    let move = new Move();

    str = str.replace(/\.|!| |(\(=\))|\?|\+|\#/gmi,""); // Remove computationally meaningless characters
    
    if (str.includes("O-O-O")) { // queenside castle
        move.pieceType = PieceType.king;
        move.dest = board.find(`.Sc${white ? 1 : 8}`);
        move.piece = board.find(`.${PieceType.king}.${white ? "white" : "black"}`);
        move.origin = board.find(`.Se${white ? 1 : 8}`);
        move.operations.push(() => {
            board.find(`.Sa${white ? 1 : 8} > .piece`).appendTo(board.find(`.Sd${white ? 1 : 8}`));
        });
        return move;
    }
    if (str.includes("O-O")) { // kingside castle
        move.pieceType = PieceType.king;
        move.dest = board.find(`.Sg${white ? 1 : 8}`);
        move.piece = board.find(`.${PieceType.king}.${white ? "white" : "black"}`);
        move.origin = board.find(`.Se${white ? 1 : 8}`);
        move.operations.push(() => {
            board.find(`.Sh${white ? 1 : 8} > .piece`).appendTo(board.find(`.Sf${white ? 1 : 8}`));
        });
        return move;        
    }
    
    let promotingPiece = null;
    if (str.includes("=")) {
        promotingPiece = str[str.length - 1];
        str = str.substring(0,str.length-2);
        move.operations.push(() => {
            let piece = move.dest.find(">:first-child");
            piece.removeClass("P");
            piece.addClass(promotingPiece);
        })
    }

    for (const type in PieceType) // note that "type" is the key
        if (PieceType[type] == str[0]) {
            move.pieceType = PieceType[type];
            break;
        }
    if (move.pieceType == null) {
        move.pieceType = PieceType.pawn;
        str = str.padStart(str.length + 1, PieceType.pawn);
    }
    
    taking = false
    if (str.includes("x")) {
        taking = true;
        str = str.replace("x","");
    }
    
    move.dest = board.find(`.S${str.substring(str.length - 2,str.length)}`);
    
    if (taking) {
        move.taking = move.dest.find(">:first-child");
        delete taking;
    }

    // DISAMBIGATION

    /** @type {Array} */
    let possibilities = board.find(`.${move.pieceType}.${white ? "white" : "black"}`);
    
    /**
     * If there's only one of the pieces, simply select that one.
     * @returns {Move}
     */
    const checkpoint = () => {
        move.piece = possibilities[0];
        move.origin = board.find(possibilities[0]).parent();
        return move;
    };

    // Make sure that all possibilites meet origin requirements.
    if (str.length > 3) {
        let originStr = str.substring(1,str.length-2);

        const fileSearch = originStr.search(/[a-z]/),
              rankSearch = originStr.search(/\d/);

        possibilities = possibilities.filter(i => isAt( board.find(possibilities[i]).parent(), fileSearch == -1 ? "-1" : originStr.charAt(fileSearch), rankSearch == -1 ? -1 : parseInt( originStr.charAt(rankSearch) )) );
    }
    const destinationClasses = move.dest.attr('class');
    if (move.pieceType == PieceType.pawn && (move.taking != null && !isPieceAt(file(destinationClasses), rank(destinationClasses), board))) {
        move.takingCell = board.find(`.S${file(destinationClasses)}${rank(destinationClasses) + (white ? -1 : 1)}`);
        move.operations.push(() => {
            move.takingCell.find("> .piece").remove();
        });
    } else {
        move.takingCell = move.dest;
    }

    console.log(`Checkpoint 1 (Piece type, color, and origin) : ${possibilities.length}`);
    if (possibilities.length == 1) return checkpoint();

    else if (move.pieceType == PieceType.rook) {
        // Check if they are on the same row and or same rank.
        possibilities = possibilities.filter(i => {
            const originClasses = board.find(possibilities[i]).parent().attr('class');
            
            //return o_file == d_file || o_rank == d_rank;
            return  compareClass("file", originClasses, destinationClasses)
                    ||
                    compareClass("rank", originClasses, destinationClasses);
        });
    }
    else if (move.pieceType == PieceType.bishop) {
        // Check if they are on the same row and or same rank.
        possibilities = possibilities.filter(i => {
            let originClasses = board.find(possibilities[i]).parent().attr('class');

            return Math.abs(rank(originClasses) - rank(destinationClasses)) == Math.abs(file(originClasses).charCodeAt(0) - file(destinationClasses).charCodeAt(0));
        });
    }
    else if (move.pieceType == PieceType.queen) {
        // Check if they are on the same row and or same rank.
        possibilities = possibilities.filter(i => {
            const originClasses = board.find(possibilities[i]).parent().attr('class');

            return  compareClass("file", originClasses, destinationClasses)
                    ||
                    compareClass("rank", originClasses, destinationClasses)
                    ||
                    Math.abs(rank(originClasses) - rank(destinationClasses)) == Math.abs(file(originClasses).charCodeAt(0) - file(destinationClasses).charCodeAt(0));
        });
    }
    else if (move.pieceType == PieceType.knight) {
        // Check if they are on the same row and or same rank.
        possibilities = possibilities.filter(i => {
            const originClasses = board.find(possibilities[i]).parent().attr('class');

            const file_distance = Math.abs(file(originClasses).charCodeAt(0) - file(destinationClasses).charCodeAt(0));
                  rank_distance = Math.abs(rank(originClasses) - rank(destinationClasses));

            // delta rank + delta file = 3
            return  rank_distance + file_distance == 3
                    &&
                    file_distance != 0
                    &&
                    rank_distance != 0;
        });
    }
    else if (move.pieceType == PieceType.pawn) {
        // Check if they are on the same row and or same rank.
        possibilities = possibilities.filter(i => {
            const originClasses = board.find(possibilities[i]).parent().attr('class');

            const file_distance = Math.abs(file(originClasses).charCodeAt(0) - file(destinationClasses).charCodeAt(0)),
                   current_rank = rank(originClasses),
                   signed_rank_distance = rank(destinationClasses) - current_rank;
            
            // console.log(signed_rank_distance == (white ? 1 : -1));
            // note that rank is accounted for higher.
            return ((white && current_rank == 2) || (!white && current_rank == 7)) ?
                            (
                                file_distance == 0 && (white ?
                                    (0 < signed_rank_distance && signed_rank_distance <= 2) 
                                    : 
                                    (-2 <= signed_rank_distance && signed_rank_distance <= 0)
                                )
                            )
                            :
                            (
                                file_distance == (move.taking != null ? 1 : 0)
                                &&
                                signed_rank_distance == (white ? 1 : -1)
                            );
        });
    }
    
    console.log(`Checkpoint 2 (Specific movement types) : ${possibilities.length}`);
    if (possibilities.length == 1) return checkpoint();
    
    if (move.pieceType == PieceType.rook) {
        possibilities = possibilities.filter(i => {
            const originClasses = board.find(possibilities[i]).parent().attr('class');
            
            const rankDest = rank(destinationClasses),
                rankOrigin = rank(originClasses);
            const fileDest = file(destinationClasses).charCodeAt(0) - 97,
                fileOrigin = file(originClasses).charCodeAt(0) - 97;

            console.log(originClasses);

            if (rankDest == rankOrigin) {
                // go through file
                if (fileDest > fileOrigin) for (let i = fileOrigin + 1; i < fileDest; i++) {
                    if (isPieceAt(alphabet[i], rankDest, board)) return false;
                } else for (let i = fileOrigin - 1; i > fileDest; i--) {
                    if (isPieceAt(alphabet[i], rankDest, board)) return false;
                }
            } else {
                // go through rank
                if (rankDest > rankOrigin) for (let i = rankOrigin + 1; i < rankDest; i++) {
                    if (isPieceAt(alphabet[fileDest], i, board)) return false;
                } else for (let i = rankOrigin - 1; i > rankDest; i--) {
                    if (isPieceAt(alphabet[fileDest], i, board)) return false;
                }
            }
            
            return true;
        });
    }
    else if (move.pieceType == PieceType.bishop) {
        possibilities = possibilities.filter(i => {
            const originClasses = board.find(possibilities[i]).parent().attr('class');
            
            const rankDest = rank(destinationClasses),
                rankOrigin = rank(originClasses),
              rankIncrease = rankDest > rankOrigin;

            const fileDest = file(destinationClasses).charCodeAt(0) - 97,
                fileOrigin = file(originClasses).charCodeAt(0) - 97,
              fileIncrease = fileDest > fileOrigin;

            const difference = Math.abs(rankDest - rankOrigin);

            for (let i = 1; i < difference; i++) {
                if (isPieceAt(alphabet[fileOrigin + (fileIncrease ? i : -i)], rankOrigin + (rankIncrease ? i : -i), board)) return false;
            }
            
            return true;
        });
    }  
    else if (move.pieceType == PieceType.queen) {
        possibilities = possibilities.filter(i => {
            const originClasses = board.find(possibilities[i]).parent().attr('class');
            
            const rankDest = rank(destinationClasses),
                rankOrigin = rank(originClasses),
              rankIncrease = rankDest > rankOrigin;

            const fileDest = file(destinationClasses).charCodeAt(0) - 97,
                fileOrigin = file(originClasses).charCodeAt(0) - 97,
              fileIncrease = fileDest > fileOrigin;

            const difference = Math.abs(rankDest - rankOrigin);
            
            if (rankDest == rankOrigin) {
                // go through file
                if (fileIncrease) for (let i = fileOrigin + 1; i < fileDest; i++) {
                    if (isPieceAt(alphabet[i], rankDest, board)) return false;
                } else for (let i = fileOrigin - 1; i > fileDest; i--) {
                    if (isPieceAt(alphabet[i], rankDest, board)) return false;
                }
            } else if (fileDest == fileOrigin) {
                // go through rank
                if (rankIncrease) for (let i = rankOrigin + 1; i < rankDest; i++) {
                    if (isPieceAt(alphabet[fileDest], i, board)) return false;
                } else for (let i = rankOrigin - 1; i > rankDest; i--) {
                    if (isPieceAt(alphabet[fileDest], i, board)) return false;
                }
            } else for (let i = 1; i < difference; i++) {
                if (isPieceAt(alphabet[fileOrigin + (fileIncrease ? i : -i)], rankOrigin + (rankIncrease ? i : -i), board)) return false;
            }
            
            return true;
        });
    }
    // Note that knight can jump over things so it doesn't have walling.
    
    console.log(`Checkpoint 3 (Walled) : ${possibilities.length}`);
    if (possibilities.length == 1) return checkpoint();

    const kingClasses = board.find(`.K.${white ? "white" : "black"}`).parent().attr('class'),
                   kr = rank(kingClasses),
                   kf = file(kingClasses);
    possibilities = possibilities.filter(i => {
        const originClasses = board.find(possibilities[i]).parent().attr('class');
        
        const r = rank(originClasses),
              f = file(originClasses),
             dr = r - kr,
             df = f.charCodeAt(0) - kf.charCodeAt(0);

        let diagonal_check = (file,rank) => {
            // remove from possibilities if it is a B or queen.
            return !$(`.S${file}${rank} > .piece`).is(`.B.${white ? "black" : "white"}, .Q.${white ? "black" : "white"}`);
        };

        if (dr == 0) {
            // horizontal

            // if they stay on the file, they're fine,
            if (rank(destinationClasses) - kr == 0) return true;
            
            let check = (file) => {
                // remove from possibilities if it is a rook or queen.
                return !$(`.S${file}${r} > .piece`).is(`.R.${white ? "black" : "white"}, .Q.${white ? "black" : "white"}`);
            };
            
            // (note 104 is char code of h)
            // for each, if files aren't the same, and there is a piece, return 'check'.
            if (df > 0) for (let i = kf.charCodeAt(0) + 1; i <= 104; i++) if (alphabet[i - 97] != f && isPieceAt(alphabet[i - 97], r, board)) return check(alphabet[i - 97]);
            else        for (let i = kf.charCodeAt(0) - 1; i >= 97;  i--) if (alphabet[i - 97] != f && isPieceAt(alphabet[i - 97], r, board)) return check(alphabet[i - 97]);
        } else if (df == 0) {
            // vertical            

            // if they stay on the rank, they're fine,
            if (file(destinationClasses).charCodeAt(0) - kf.charCodeAt(0) == 0) return true;

            let check = (rank) => {
                // remove from possibilities if it is a rook or queen.
                if (rank != r && isPieceAt(f, rank, board)) return !$(`.S${f}${rank} > .piece`).is(`.B.${white ? "black" : "white"}, .Q.${white ? "black" : "white"}`);
            };

            // for each, if ranks aren't the same, and there is a piece, return 'check'
            if (dr > 0) for (let i = kr + 1; i <= 8; i++) if (i != r && isPieceAt(f, i, board)) return check(i);
            else        for (let i = kr - 1; i >= 1; i--) if (i != r && isPieceAt(f, i, board)) return check(i);
        } else if (df == dr) {
            // gradient = 1

            // if they stay on the same diagonal, they're fine,
            if (file(destinationClasses).charCodeAt(0) - kf.charCodeAt(0) == rank(destinationClasses) - kr) return true;

            // if pieces aren't the same, and there is a piece, return 'diagonal_check'.
            if (df > 0) for (let i = kr + 1; i <= 8; i++) {
                let file = alphabet(kf + i - kr);
                if (file != f && i != r && isPieceAt(file, i, board)) return diagonal_check(file, i);
            }
            else for (let i = kr - 1; i >= 1; i--) {
                let file = alphabet(kf + i - kr);
                if (file != f && i != r && isPieceAt(file, i, board)) return diagonal_check(file, i);
            }
        } else if (df == -dr) {
            // gradient = -1
            
            // if they stay on the same diagonal, they're fine,
            if (file(destinationClasses).charCodeAt(0) - kf.charCodeAt(0) == -rank(destinationClasses) + kr) return true;
            
            // if pieces aren't the same, and there is a piece, return 'diagonal_check'.
            if (df > 0) for (let i = kr + 1; i <= 8; i++) {
                let file = alphabet(kf - (i - kr));
                if (file != f && i != r && isPieceAt(file, i, board)) return diagonal_check(file, i);
            }
            else for (let i = kr - 1; i >= 1; i--) {
                let file = alphabet(kf - (i - kr));
                if (file != f && i != r && isPieceAt(file, i, board)) return diagonal_check(file, i);
            }
            
        } else return true;
    });

    // console.log(`Checkpoint 4 (Check) : ${possibilities.length}`);
    if (possibilities.length == 1) return checkpoint();
}

// Implementation of compiler

/**
 * @type {Array<Board>}
 */
let board = null;
let boards = {};
class Board {
    constructor(id) {
        this.id = id;
        boards[this.id] = this;

        this.currentMove = 0;

        this.object = $(`#board-${this.id}`);
        this.container = this.object.parent();
    }    

    nextMove() {
        if (this.currentMove >= this.moves.length) return;
        
        let move = compile_move(this.moves[this.currentMove], this.currentMove++ % 2 == 0, this.object);
        
        const children = move.dest.find(">:first-child");
        children.length != 0 && children.remove();
    
        $(move.piece).appendTo(move.dest);
        move.operations.forEach(fn => fn());
    }

    setMove(n) { 
        let diff = n+1 - this.currentMove; 
        while (diff--) this.nextMove(); 
    }
}