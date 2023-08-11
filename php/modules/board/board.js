/**
 * @returns {false}
 */
const FALSE = () => false;

/**
 * Converts radians to degrees
 * @param {number} rad An angle in radians
 * @returns {number} The given angle converted to degrees
 */
const radToDegree = rad => (rad > 0 ? rad : (2*Math.PI + rad)) * 360 / (2*Math.PI);

const descends = (child, parent) => $(child).closest(parent).length > 0;

/**
 * Represents a 2D point/coordinate.
 */
class Point {
    /**
     * Default constructor.
     * @param {number} x The x coordinate (first dimension) of the point.
     * @param {number} y The y coordinate (second dimension) of the point.
     */
    constructor(x,y) {
        this.x = x;
        this.y = y;
    }

    /**
     * To be thought as the same as using '+' on this and the given point. 
     * @param {Point} p the point that you are adding.
     * @returns {Point} the result of the addition.
     */
    _plus(p) { return new Point(this.x + p.x, this.y + p.y); }
    /**
     * @param {Point} p the point that you are subtracting.
     * @returns {Point} the result of the subtraction.
     */
    _minus(p) { return new Point(this.x - p.x, this.y - p.y); }
    /**
     * @param {Point} p the point that you checking equality with.
     * @returns {Point} whether the two points are equal.
     */
    _equals(p) { return this.x == p.x && this.y == p.y; }

    /**
     * @returns {number} the distance to the point from the point from the origin using the pythagorean theorem.
     */
    magnitude() { return Math.sqrt(this.x**2 + this.y**2); }
    /**
     * @param {Point} p the point to calculate the relative angle to.
     * @returns {number} angle in degrees from this point to the given point.
     */
    angle(p) { return radToDegree(Math.atan2(p.y - this.y, p.x - this.x)) }

    /**
     * @example `${x}, ${y}`
     * @returns {string} the point represented as a string
     */
    toString() { return `${this.x}, ${this.y}` }
};

const alphabet = 'abcdefghijklmnopqrstuvwxyz';

//TODO: add capability to have multiple boards without interfering.
$(document).ready(() => {
    // Toggling square selection for note taking
    let squares = $(".square");

    squares.contextmenu(e => {
        let target = $(e.currentTarget);
        if (target.hasClass("piece")) target = target.parent();

        target.hasClass("selected") ? target.removeClass("selected") : target.addClass("selected");

        return false;
    });

    // Keeping Mouse Position
    let mousePosition = new Point(0,0);
    $(document).mousemove(e => {
        mousePosition.x = e.pageX;
        mousePosition.y = e.pageY;
    });

    // Arrows
    let hoveringCellPosition = new Point(0,0);    
    squares.mouseover(e => {
        const rect = e.currentTarget.getBoundingClientRect()
        hoveringCellPosition = new Point((rect.left + rect.right)/2 + window.scrollX, (rect.top + rect.bottom)/2 + window.scrollY) 
    });

    let rightMouseDown = false,
        arrowLoopID;
    $(".board").mousedown(e => { 
        const board = $(e.currentTarget);
        switch(e.which) {        
            case 1:
                // Clearing all notes
                board.find(".square").removeClass("selected");
                $(`.arrow-${board.attr("id").at(-1)}`).remove();
                break;
            case 3:
                // Mark that the right mouse is being held down
                rightMouseDown = true;

                // Save point that arrow started
                let arrowStart = hoveringCellPosition;

                // Create the container for the arrow
                let arrowContainer = $(document.createElement('div'))
                    .addClass("arrow")
                    .addClass(`arrow-${board.attr("id").at(-1)}`)
                    .appendTo("body")
                    .bind("contextmenu", FALSE)
                    .bind("mousedown", e => e.which == 1 && $(e.currentTarget).remove())
                    .css({
                        top: arrowStart.y,
                        left: arrowStart.x
                    });
                
                // Set cell width
                let cellWidth = squares[0].getBoundingClientRect().width;

                // Create the main body of the arrow
                let arrowBody = $(document.createElement('div'))
                    .appendTo(arrowContainer)
                    .bind("contextmenu", FALSE)
                    .css({
                        height: 4*cellWidth/15,
                        top: -2*cellWidth/15
                    });

                // Create the arrow head
                let arrowHead = $(document.createElement('img'))
                    .appendTo(arrowContainer)
                    .addClass("arrowHead")
                    .bind("contextmenu", FALSE)
                    .attr("src", "/res/arrowHead.svg")
                    .css({
                        height: cellWidth/2,
                        width: 2*cellWidth/3,
                        top: -cellWidth/2,
                        visibility: "hidden" // remove?
                    });

                // Create the loop to update the arrow
                arrowLoopID = setInterval(() => {
                    if (!rightMouseDown) return;
                    
                    arrowBody.css({ width: hoveringCellPosition._minus(arrowStart).magnitude() - cellWidth/2 });
                    arrowHead.css({ 
                        left: hoveringCellPosition._minus(arrowStart).magnitude() - cellWidth/2 - 9,
                        visibility: hoveringCellPosition._equals(arrowStart) ? "hidden" : "visible"
                    });
                    arrowContainer.css({ '-webkit-transform': `rotate(${arrowStart.angle(hoveringCellPosition)}deg)` });
                }, 100);
                break;
        }
    });

    // Stop updating arrows
    $(document).mouseup(e => { 
        if (e.which != 3) return;
        
        // Mark that the right mouse is no longer being held down
        rightMouseDown = false;
        // Stop the loop that updates an arrow.
        clearInterval(arrowLoopID);
    });
        
    $(".next-move").mousedown(e => {
        if (e.which != 1) return;
        
        boards[$(e.currentTarget).attr("id").at(-1)].nextMove();
    });
        
    $(".last-move").mousedown(e => {
        if (e.which != 1) return;
        
        boards[$(e.currentTarget).attr("id").at(-1)].lastMove();
    });

    $(".board-container").each((i, ele) => {
        let board = new Board();

        $(ele).attr("id", `board-container-${board.id}`);
        $(ele).find(".next-move").attr("id", `next-move-${board.id}`);
        $(ele).find(".last-move").attr("id", `last-move-${board.id}`);
        $(ele).find(".board").attr("id", `board-${board.id}`);
    })
});

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
    takingCell = null; 
    /**
     * @type {Array}
     */
    operations = [];
    /**
     * @type {Array}
     */
    reverse_operations = [];
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
const rank = (classes) => parseInt(classes[classes.search(/rank-\d/) + 5]);
/**
 * @param {string} classes 
 * @returns {string}
 */
const file = (classes) => classes.charAt(classes.search(/file-[a-z]/) + 5); 
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
function compile_move(str, white, boardID) {
    /** @type {Move} */
    let move = new Move();
    const board = $(`#board-${boardID}`);

    str = str.replace(/\.|!| |(\(=\))|\?|\+|\#/gmi,""); // Remove computationally meaningless characters
    
    if (str.includes("O-O-O")) { // queenside castle
        move.pieceType = PieceType.king;
        move.dest = board.find(`.Sc${white ? 1 : 8}`);
        move.piece = board.find(`.${PieceType.king}.${white ? "white" : "black"}`);
        move.origin = board.find(`.Se${white ? 1 : 8}`);
        move.operations.push(() => {
            board.find(`.Sa${white ? 1 : 8} > .piece`).appendTo(board.find(`.Sd${white ? 1 : 8}`));
        });
        move.reverse_operations.push(() => {
            board.find(`.Sd${white ? 1 : 8}`).appendTo(board.find(`.Sa${white ? 1 : 8} > .piece`));
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
        move.reverse_operations.push(() => {
            board.find(`.Sf${white ? 1 : 8}`).appendTo(board.find(`.Sh${white ? 1 : 8} > .piece`));
        });
        return move;        
    }
    
    let promotingPiece = null;
    if (str.includes("=")) {
        promotingPiece = str[str.length - 1];
        str = str.substring(0,str.length-2);
        move.operations.push(() => {
            piece = move.dest.find(">:first-child");
            piece.removeClass("P");
            piece.addClass(promotingPiece);
        })
        move.reverse_operations.push(() => {
            piece = move.dest.find(">:first-child");
            piece.removeClass(promotingPiece);
            piece.addClass("P");
        });
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

    move.pieceType = PieceType[Object.keys(PieceType).find(type => PieceType[type] == str[0])];
    move.dest = board.find(`.S${str.substring(str.length - 2,str.length)}`);

    if (str.includes("x")) {
        move.taking = move.dest.find(">:first-child");
        str = str.replace("x","");
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
    if (move.pieceType == PieceType.pawn && (move.taking != null && !isPieceAt(file(destinationClasses), rank(destinationClasses)))) {
        move.takingCell = board.find(`.S${file(destinationClasses)}${rank(destinationClasses) + (white ? -1 : 1)}`)
        move.operations.push(() => {
            move.takingCell.find("> .piece").remove();
        });
    } else {
        move.takingCell = move.dest;
    }

    // console.log(`Checkpoint 1 (Piece type, color, and origin) : ${possibilities.length}`);
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
        let destinationClasses = move.dest.attr('class');
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

            // delta rank + delta file = 3
            return  Math.abs(rank(originClasses) - rank(destinationClasses)) + file_distance == 3
                    &&
                    file_distance != 0;
        });
    }
    else if (move.pieceType == PieceType.pawn) {
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
    
    if (move.pieceType == PieceType.rook) {
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
                if (isPieceAt(alphabet[fileOrigin + (fileIncrease ? i : -i)], rankOrigin + (rankIncrease ? i : -i))) return false;
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

let boardsN = 0;
/**
 * @type {Array<Board>}
 */
let boards = {};
class Board {
    constructor() {
        this.id = boardsN++;
        boards[this.id] = this;

        this.currentMove = 0;
        this.moves = [
            "e4",
            "e5",
            "Nf3",
            "...f6?",
            "Nxe5",
            "...fxe5?",
            "Qh5+",
            "...Ke7",
            "Qxe5+",
            "...Kf7",
            "Bc4+",
            ".... d5!",
            "Bxd5+",
            "... Kg6",
            "h4",
            "... h5",
            " Bxb7!!",
            "... Bxb7?",
            "Qf5+",
            "... Kh6",
            "d4+",
            "... g5",
            "Qf7!",
            "... Qe7",
            "hxg5+",
            "... Qxg5",
            "Rxh5#"
        ];;
        this.compiledMoves = [];
    }    

    nextMove() {
        if (this.currentMove == this.moves.length) return;

        let move;
        if (this.compiledMoves.length > this.currentMove) {
            move = this.compiledMoves[this.currentMove++];
        } else {
            move = compile_move(this.moves[this.currentMove], this.currentMove++ % 2 == 0, this.id);
            this.compiledMoves.push(move);
        }
    
        const children = move.dest.find(">:first-child");
        children.length != 0 && children.remove();
    
        $(move.piece).appendTo(move.dest);
        move.operations.forEach(fn => fn());
    }

    lastMove() {
        if (this.currentMove == 0) return;
        
        const move = this.compiledMoves[--this.currentMove];
        
        $(move.piece).appendTo(move.origin);

        move.taking != null && move.taking.appendTo(move.takingCell);

        move.reverse_operations.forEach(fn => fn());
    }
}