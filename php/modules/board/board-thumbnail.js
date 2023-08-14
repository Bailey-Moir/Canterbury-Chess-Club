const alphabet = 'abcdefghijklmnopqrstuvwxyz';

// COMPILER

class Move {
    /**
     * @type {pieceType}
     */
    pieceType = null;
    piece = null;
    dest = null;
    origin = null;
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
const isPieceAt = (file, rank) => $(`.S${file}${rank} > .piece`).length != 0;

/**
 * Returns data about a move on the given board given a chess noation move string.
 * @param {String} str The chess notation move
 * @returns {Move}
 */
function compile_move(str, white, board) {
    /** @type {Move} */
    let move = new Move();

    let pieceType = null;

    str = str.replace(/\.|!| |(\(=\))|\?|\+|\#/gmi,""); // Remove computationally meaningless characters
    
    if (str.includes("O-O-O")) { // queenside castle
        move.dest = board.find(`.Sc${white ? 1 : 8}`);
        move.piece = board.find(`.${PieceType.king}.${white ? "white" : "black"}`);
        move.origin = move.piece.parent();
        move.operations.push(() => {
            board.find(`.Sa${white ? 1 : 8} > .piece`).appendTo(board.find(`.Sd${white ? 1 : 8}`));
        });
        return move;
    }
    if (str.includes("O-O")) { // kingside castle
        move.dest = board.find(`.Sg${white ? 1 : 8}`);
        move.piece = board.find(`.${PieceType.king}.${white ? "white" : "black"}`);
        move.origin = move.piece.parent();
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
        });
    }

    for (const type in PieceType) // note that "type" is the key
        if (PieceType[type] == str[0]) {
            pieceType = PieceType[type];
            break;
        }
    if (pieceType == null) {
        pieceType = PieceType.pawn;
        str = str.padStart(str.length + 1, PieceType.pawn);
    }
    
    move.dest = board.find(`.S${str.substring(str.length - 2,str.length)}`);

    if (str.includes("x")) {
        move.taking = move.dest.find(">:first-child");
        str = str.replace("x","");
    }

    // DISAMBIGATION

    /** @type {Array} */
    let possibilities = board.find(`.${pieceType}.${white ? "white" : "black"}`);
    
    /**
     * If there's only one of the pieces, simply select that one.
     * @returns {Move}
     */
    const checkpoint = () => {
        move.piece = possibilities[0];
        move.origin = $(move.piece).parent();
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
    if (pieceType == PieceType.pawn && (move.taking != null && !isPieceAt(file(destinationClasses), rank(destinationClasses)))) {
        move.operations.push(() => {
            move.takingCell.find("> .piece").remove();
        });
    }

    // console.log(`Checkpoint 1 (Piece type, color, and origin) : ${possibilities.length}`);
    if (possibilities.length == 1) return checkpoint();

    else if (pieceType == PieceType.rook) {
        // Check if they are on the same row and or same rank.
        possibilities = possibilities.filter(i => {
            const originClasses = board.find(possibilities[i]).parent().attr('class');
            
            //return o_file == d_file || o_rank == d_rank;
            return  compareClass("file", originClasses, destinationClasses)
                    ||
                    compareClass("rank", originClasses, destinationClasses);
        });
    }
    else if (pieceType == PieceType.bishop) {
        // Check if they are on the same row and or same rank.
        let destinationClasses = move.dest.attr('class');
        possibilities = possibilities.filter(i => {
            let originClasses = board.find(possibilities[i]).parent().attr('class');

            return Math.abs(rank(originClasses) - rank(destinationClasses)) == Math.abs(file(originClasses).charCodeAt(0) - file(destinationClasses).charCodeAt(0));
        });
    }
    else if (pieceType == PieceType.queen) {
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
    else if (pieceType == PieceType.knight) {
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
    else if (pieceType == PieceType.pawn) {
        // Check if they are on the same row and or same rank.
        possibilities = possibilities.filter(i => {
            const originClasses = board.find(possibilities[i]).parent().attr('class');

            const file_distance = Math.abs(file(originClasses).charCodeAt(0) - file(destinationClasses).charCodeAt(0)),
           signed_rank_distance = rank(destinationClasses) - rank(originClasses);
            
           // 0 < delta rank <= 2 
            return  (white ? 
                        (0 < signed_rank_distance && signed_rank_distance <= 2) 
                        : 
                        (-2 <= signed_rank_distance && signed_rank_distance <= 0)
                    )
                    &&
                    file_distance == (move.taking != null ? 1 : 0);
        });
    }
    
    // console.log(`Checkpoint 2 (Specific movement types) : ${possibilities.length}`);
    if (possibilities.length == 1) return checkpoint();
    
    if (pieceType == PieceType.rook) {
        possibilities = possibilities.filter(i => {
            const originClasses = board.find(possibilities[i]).parent().attr('class');
            
            const rankDest = rank(destinationClasses),
                rankOrigin = rank(originClasses);
            const fileDest = file(destinationClasses).charCodeAt(0) - 97,
                fileOrigin = file(originClasses).charCodeAt(0) - 97;

            if (rankDest == rankOrigin) {
                // go through file
                if (fileDest > fileOrigin) for (let i = fileOrigin + 1; i < fileDest; i++) {
                    if (isPieceAt(alphabet[i], rankDest)) return false;
                } else for (let i = fileOrigin - 1; i > fileDest; i--) {
                    if (isPieceAt(alphabet[i], rankDest)) return false;
                }
            } else {
                // go through rank
                if (rankDest > rankOrigin) for (let i = rankOrigin + 1; i < rankDest; i++) {
                    if (isPieceAt(alphabet[fileDest], i)) return false;
                } else for (let i = rankOrigin - 1; i > rankDest; i--) {
                    if (isPieceAt(alphabet[fileDest], i)) return false;
                }
            }
            
            return true;
        });
    }
    else if (pieceType == PieceType.bishop) {
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
                if (isPieceAt(alphabet[fileOrigin + (fileIncrease ? i : -i)], rankOrigin + (rankIncrease ? i : -i))) return false;
            }
            
            return true;
        });
    }  
    else if (pieceType == PieceType.queen) {
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
                    if (isPieceAt(alphabet[i], rankDest)) return false;
                } else for (let i = fileOrigin - 1; i > fileDest; i--) {
                    if (isPieceAt(alphabet[i], rankDest)) return false;
                }
            } else if (fileDest == fileOrigin) {
                // go through rank
                if (rankIncrease) for (let i = rankOrigin + 1; i < rankDest; i++) {
                    if (isPieceAt(alphabet[fileDest], i)) return false;
                } else for (let i = rankOrigin - 1; i > rankDest; i--) {
                    if (isPieceAt(alphabet[fileDest], i)) return false;
                }
            } else for (let i = 1; i < difference; i++) {
                if (isPieceAt(alphabet[fileOrigin + (fileIncrease ? i : -i)], rankOrigin + (rankIncrease ? i : -i))) return false;
            }
            
            return true;
        });
    }
    // Note that knight can jump over things so it doesn't have walling.
    
    // console.log(`Checkpoint 3 (Walled) : ${possibilities.length}`);
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