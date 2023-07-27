/**
 * @returns {false}
 */
const FALSE = () => { return false; };

/**
 * Converts radians to degrees
 * @param {number} rad An angle in radians
 * @returns {number} The given angle converted to degrees
 */
const radToDegree = rad => { return (rad > 0 ? rad : (2*Math.PI + rad)) * 360 / (2*Math.PI) };

/**
 * @param {HTMLElement} element The element to get the centre of.
 * @returns {Point} The centre of the given element.
 */
const getCentre = element => {
    rect = element.getBoundingClientRect();
    return new Point((rect.left + rect.right)/2, (rect.top + rect.bottom)/2);
}

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

//TODO: add capability to have multiple boards without interfering.
$(document).ready(function() {
    // Toggling square selection for note taking
    $(".square").contextmenu(e => {
        let target = $(e.currentTarget);
        if (target.hasClass("piece")) target = target.parent();

        target.hasClass("selected") ? target.removeClass("selected") : target.addClass("selected");

        return false;
    });

    // Keeping Mouse Position
    let mousePosition = new Point(0,0)
    $(document).mousemove(e => {
        mousePosition.x = e.pageX;
        mousePosition.y = e.pageY;
    });

    // Arrows    
    let hoveringCellPosition;    
    $(".square").mouseover(e => hoveringCellPosition = getCentre(e.currentTarget));

    let rightMouseDown = false,
        arrowLoopID;
    $(".square").mousedown(e => { switch(e.which) {
        case 1:
            // Clearing all notes
            $(".square").removeClass("selected");
            $(".arrow").remove();
            break;
        case 3:
            // Mark that the right mouse is being held down
            rightMouseDown = true;

            // Save point that arrow started
            let arrowStart = getCentre(e.currentTarget);

            // Create the container for the arrow
            let arrowContainer = $(document.createElement('div'))
                .addClass("arrow")
                .appendTo(document.body)
                .bind("contextmenu", FALSE)
                .bind("mousedown", e => e.which == 1 && $(e.currentTarget).remove())
                .css({
                    top: arrowStart.y,
                    left: arrowStart.x
                });
            
            // Set cell width
            let rect = e.currentTarget.getBoundingClientRect();
            let cellWidth = rect.right - rect.left;

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
    }});

    // Stop updating arrows
    $(document).mouseup(e => { 
        if (e.which != 3) return;
        
        // Mark that the right mouse is no longer being held down
        rightMouseDown = false;
        // Stop the loop that updates an arrow.
        clearInterval(arrowLoopID);
    });
});

// COMPILER

class Move {
    /**
     * @type {pieceType}
     */
    pieceType = null;
    piece = null;
    dest = null;
    origin = null
}

const pieceType = {
    pawn: "P",
    rook: "R",
    knight: "N",
    king: "K",
    queen: "Q",
    bishop: "B",
}

/**
 * 
 * @param {String} str 
 * @returns {Move}
 */
function compile_string(str, white) {
    /** @type {Move} */
    let move = Move.new();

    str = str.replace(/!|(\(=\))|\?|\+|#/gmi,"") // Remove computationally meaningless characters
        .toUpperCase();
    
    // O-O <- kingside
    // O-O-O <- queenside
    // x <- takes
    // = <- upgrade
    
    let pieceType = null;
    for (const type in pieceType) { // note that "type" is the key
        if (pieceType[type] == str[0]) {
            pieceType = type;
            break;
        }
    }
    if (pieceType == null) {
        pieceType = pieceType.pawn;
        str = str.padStart(str.length + 1, "P");
    }
    
    move.pieceType = pieceType.keys().find(type => pieceType[type] === str[0])
    move.dest = $(`.${str.substring(str.length - 2,str.length)}`);

    // DISAMBIGATION

    /** @type {Array} */
    let possibilities = $(`.${move.pieceType}.${white ? "white" : "black"}`);

    // Make sure that all possibilites meet origin requirements.
    if (str.length > 3) {
        let origin_str = str.substring(1,str.length-2);
        let rank = origin_str.find(/\d/gmi);
        let file = origin_str.find(/[A-Z]/gmi);

        possibilities = possibilities.filter(obj => { return (file == null || obj.parent().hasClass(`file-${file}`)) && (rank == null || obj.parent().hasClass(`rank-${rank}`)); });
    }
    
    // If there's only one of the pieces, simply select that one.
    if (possibilities.length == 1) {
        move.piece = possibilities[0];
        move.origin = possibilities[0].parent();
        return move;
    }

    // Disambiguate using movement rules.    
}