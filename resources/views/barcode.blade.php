











<!--orginally based on Scott Fessler's UPC barcode generator which can we found here: https://codepen.io/FesslerForge/pen/jHkaC I'm mainly making this is a proof of concept for work. Main goal is to create a tool where users can either select from predetermined label sizes or eventually create a custom size. First decent sized project in probably 10 years coding is probably god awful compared to the work of other people on the platform-->

<div id="testsection1">
    <FORM NAME="128b">
      <P><span style="font-weight:bold;">Barcodes:</span><br>
        <textarea name="Text1" id="128bval" cols="40" rows="5" placeholder="Start a new line to start a new barcode. Barcodes are case sensitive."></textarea>
      </p>
      <p><span style="font-weight:bold;">Barcode Size:</span><br> <select id="bcsize">
          <option value="4x6">4x6 text</option>
          <option value="4x6nt">4x6 no text</option>
          <option value="3x9nt">3x9 no text</option>
          <option value="2x6">2x6 text</option>
          <option value="2x3">2x3 text</option>
          <option value="custom">Custom(not working yet)</option>
        </select>
      </p>
  
      <INPUT TYPE="Button" Value="Print" id="submitbutton" onClick="test()">
    </FORM>
  </div>
  <div id="testsection2" style="display: block;">
    <p id="testoutput">Test
    </p>
  </div>
  <div id="container">
  </div>
  <!-----------///////////////////////--->

  

  <script>
      function test() {
  // list of all of the modules and thier values
  const bcvalues = [
    { value: 0, character: " ", pattern: "11011001100" },
    { value: 1, character: "!", pattern: "11001101100" },
    { value: 2, character: '"', pattern: "11001100110" },
    { value: 3, character: "#", pattern: "10010011000" },
    { value: 4, character: "$", pattern: "10010001100" },
    { value: 5, character: "%", pattern: "10001001100" },
    { value: 6, character: "&", pattern: "10011001000" },
    { value: 7, character: "'", pattern: "10011000100" },
    { value: 8, character: "(", pattern: "10001100100" },
    { value: 9, character: ")", pattern: "11001001000" },
    { value: 10, character: "*", pattern: "11001000100" },
    { value: 11, character: "+", pattern: "11000100100" },
    { value: 12, character: ",", pattern: "10110011100" },
    { value: 13, character: "-", pattern: "10011011100" },
    { value: 14, character: ".", pattern: "10011001110" },
    { value: 15, character: "/", pattern: "10111001100" },
    { value: 16, character: "0", pattern: "10011101100" },
    { value: 17, character: "1", pattern: "10011100110" },
    { value: 18, character: "2", pattern: "11001110010" },
    { value: 19, character: "3", pattern: "11001011100" },
    { value: 20, character: "4", pattern: "11001001110" },
    { value: 21, character: "5", pattern: "11011100100" },
    { value: 22, character: "6", pattern: "11001110100" },
    { value: 23, character: "7", pattern: "11101101110" },
    { value: 24, character: "8", pattern: "11101001100" },
    { value: 25, character: "9", pattern: "11100101100" },
    { value: 26, character: ":", pattern: "11100100110" },
    { value: 27, character: ";", pattern: "11101100100" },
    { value: 28, character: "<", pattern: "11100110100" },
    { value: 29, character: "=", pattern: "11100110010" },
    { value: 30, character: ">", pattern: "11011011000" },
    { value: 31, character: "?", pattern: "11011000110" },
    { value: 32, character: "@", pattern: "11000110110" },
    { value: 33, character: "A", pattern: "10100011000" },
    { value: 34, character: "B", pattern: "10001011000" },
    { value: 35, character: "C", pattern: "10001000110" },
    { value: 36, character: "D", pattern: "10110001000" },
    { value: 37, character: "E", pattern: "10001101000" },
    { value: 38, character: "F", pattern: "10001100010" },
    { value: 39, character: "G", pattern: "11010001000" },
    { value: 40, character: "H", pattern: "11000101000" },
    { value: 41, character: "I", pattern: "11000100010" },
    { value: 42, character: "J", pattern: "10110111000" },
    { value: 43, character: "K", pattern: "10110001110" },
    { value: 44, character: "L", pattern: "10001101110" },
    { value: 45, character: "M", pattern: "10111011000" },
    { value: 46, character: "N", pattern: "10111000110" },
    { value: 47, character: "O", pattern: "10001110110" },
    { value: 48, character: "P", pattern: "11101110110" },
    { value: 49, character: "Q", pattern: "11010001110" },
    { value: 50, character: "R", pattern: "11000101110" },
    { value: 51, character: "S", pattern: "11011101000" },
    { value: 52, character: "T", pattern: "11011100010" },
    { value: 53, character: "U", pattern: "11011101110" },
    { value: 54, character: "V", pattern: "11101011000" },
    { value: 55, character: "W", pattern: "11101000110" },
    { value: 56, character: "X", pattern: "11100010110" },
    { value: 57, character: "Y", pattern: "11101101000" },
    { value: 58, character: "Z", pattern: "11101100010" },
    { value: 59, character: "[", pattern: "11100011010" },
    { value: 60, character: "\\", pattern: "11101111010" },
    { value: 61, character: "]", pattern: "11001000010" },
    { value: 62, character: "^", pattern: "11110001010" },
    { value: 63, character: "_", pattern: "10100110000" },
    { value: 64, character: "`", pattern: "10100001100" },
    { value: 65, character: "a", pattern: "10010110000" },
    { value: 66, character: "b", pattern: "10010000110" },
    { value: 67, character: "c", pattern: "10000101100" },
    { value: 68, character: "d", pattern: "10000100110" },
    { value: 69, character: "e", pattern: "10110010000" },
    { value: 70, character: "f", pattern: "10110000100" },
    { value: 71, character: "g", pattern: "10011010000" },
    { value: 72, character: "h", pattern: "10011000010" },
    { value: 73, character: "i", pattern: "10000110100" },
    { value: 74, character: "j", pattern: "10000110010" },
    { value: 75, character: "k", pattern: "11000010010" },
    { value: 76, character: "l", pattern: "11001010000" },
    { value: 77, character: "m", pattern: "11110111010" },
    { value: 78, character: "n", pattern: "11000010100" },
    { value: 79, character: "o", pattern: "10001111010" },
    { value: 80, character: "p", pattern: "10100111100" },
    { value: 81, character: "q", pattern: "10010111100" },
    { value: 82, character: "r", pattern: "10010011110" },
    { value: 83, character: "s", pattern: "10111100100" },
    { value: 84, character: "t", pattern: "10011110100" },
    { value: 85, character: "u", pattern: "10011110010" },
    { value: 86, character: "v", pattern: "11110100100" },
    { value: 87, character: "w", pattern: "11110010100" },
    { value: 88, character: "x", pattern: "11110010010" },
    { value: 89, character: "y", pattern: "11011011110" },
    { value: 90, character: "z", pattern: "11011110110" },
    { value: 91, character: "{", pattern: "11110110110" },
    { value: 92, character: "|", pattern: "10101111000" },
    { value: 93, character: "}", pattern: "10100011110" },
    { value: 94, character: "~", pattern: "10001011110" },
    { value: 95, character: "DEL", pattern: "10111101000" },
    { value: 96, character: "FNC 3", pattern: "10111100010" },
    { value: 97, character: "FNC 2", pattern: "11110101000" },
    { value: 98, character: "Shift A", pattern: "11110100010" },
    { value: 99, character: "Code C", pattern: "10111011110" },
    { value: 100, character: "FNC 4", pattern: "10111101110" },
    { value: 101, character: "Code A", pattern: "11101011110" },
    { value: 102, character: "FNC 1", pattern: "11110101110" },
    { value: 103, character: "Start Code A", pattern: "11010000100" },
    { value: 104, character: "Start Code B", pattern: "11010010000" },
    { value: 105, character: "Start Code C", pattern: "11010011100" },
    { value: 106, character: "Stop", pattern: "11000111010" },
    { value: 107, character: "Reverse Stop", pattern: "11010111000" },
    { value: 108, character: "Stop Pattern", pattern: "1100011101011" }
  ];
  // Calculates the check value. From https://en.wikipedia.org/wiki/Code_128 The check digit is a weighted modulo-103 checksum. It is calculated by summing the start code 'value' to the products of each symbol's 'value' multiplied by its position in the barcode string.
  let x; // barcode width
  let y; // barcode height
  let vm; // vertical margins
  let dfs; // fontsize
  let tx; // text x coordinate start
  let ty; // text x coordinate start
  let bx; // barcode x coordinate start
  let by; // barcode y coordinate start
  const b = document.getElementById("128bval").value; // pulls value from barcode text box
  const t = document.getElementById("output"); // spits out text used for testing variable values during build
  var ct = document.getElementById("container"); // div container for canvases
  const printbutton = document.getElementById("printbutton");
  const submitbutton = document.getElementById("submitbutton");
  const bcsize = document.getElementById("bcsize").value;
  let barHeight;
  let tc; // text check if 0 then no if 1 yes;
  const blist = b.split("\n");
  let bnum;

  // sets inital values based on barcode type
  if (bcsize === "4x6") {
    x = 600;
    y = 400;
    vm = 10;
    dfs = 90;
    tx = 0;
    ty = 95;
    bx = 0;
    by = 105;
    barHeight = 290;
    tc = 1;
  } else if (bcsize === "4x6nt") {
    x = 600;
    y = 400;
    vm = 0;
    dfs = 0;
    tx = 0;
    ty = 0;
    bx = 0;
    by = 0;
    barHeight = 400;
    tc = 0;
  } else if (bcsize === "3x9nt") {
    x = 900;
    y = 300;
    vm = 0;
    dfs = 0;
    tx = 0;
    ty = 0;
    bx = 0;
    by = 0;
    barHeight = 300;
    tc = 0;
  } else if (bcsize === "2x6") {
    x = 600;
    y = 200;
    vm = 10;
    dfs = 90;
    tx = 0;
    ty = 95;
    bx = 0;
    by = 105;
    barHeight = 90;
    tc = 1;
  } else if (bcsize === "2x3") {
    x = 300;
    y = 200;
    vm = 10;
    dfs = 45;
    tx = 0;
    ty = 50;
    bx = 0;
    by = 60;
    barHeight = 135;
    tc = 1;
  } else if (bcsize === "custom") {
    x = 0;
    y = 0;
    vm = 0;
    dfs = 0;
    tx = 0;
    ty = 0;
    bx = 0;
    by = 0;
    barHeight = 0;
  } else {
    x = 0;
    y = 0;
    vm = 0;
    dfs = 0;
    tx = 0;
    ty = 0;
    bx = 0;
    by = 0;
    barHeight = 0;
    tc = 0;
  }

  // delete old canvases
  let temp2;
  const temp = document.getElementsByClassName("barcodes").length;
  for (var i = temp; i > 0; --i) {
    temp2 = "barcode" + i;
    document
      .getElementById(temp2)
      .parentNode.removeChild(document.getElementById(temp2));
  }

  bnum = blist.length;
  for (let k = 1; k <= bnum; ++k) {
    const bc = blist[k - 1].split(""); // takes the barcode value and splits it into an array
    let check = 104; // initializing the check value for calculation to 103 since all of the barcodes I plan to make are 128b and this is the b start code.

    let bcst = "0000000000" + bcvalues[104].pattern; // adding leading zero's/whitespace to the barcode because in order to scan it must have at least 10 leading blank spaces
    for (var i = 0; i < bc.length; ++i) {
      // for each barcode character from the textbox
      for (let it = 0; it < bcvalues.length; ++it) {
        // for each 128barcode value
        if (bc[i] == bcvalues[it].character) {
          // compare to see if they are the same
          check += bcvalues[it].value * (i + 1); // if they are the same then add to the check digit the multiple of the characters position times it's value
          bcst += bcvalues[it].pattern; // add's 1's and 0's to the pattern for coloring the barcode
        } else {
          check = check; // otherwise do nothing
        }
      }
    }
    check %= 103; // calculating the mod of the check digit by dividing by 103.
    let toutput = document.getElementById("testoutput");
    toutput.innerText = check;
    bcst =
      bcst + bcvalues[check].pattern + bcvalues[108].pattern + "0000000000";
    // Code for generating actual image
    // Set width of barcode modules and adjusts starting postion so that it's center on the label
    const barWidth = /*Math.floor*/ x / bcst.length;
    const adjustedStart = x / 2 - (barWidth * bcst.length) / 2;

    // create new canvas
    var ct = document.getElementById("container");
    const bcode = document.createElement("canvas");
    bcode.setAttribute("id", "barcode" + k);
    bcode.setAttribute("class", "barcodes");
    bcode.setAttribute("width", x);
    bcode.setAttribute("height", y);
    bcode.setAttribute("style", "display:none;"); // originally had barcodes displaying before clicking seperate button to print. Leaving code like this in case I ever have to go back and trouble shoot
    ct.append(bcode);
    const ctx = bcode.getContext("2d");
    const bcstd = bcst.split("");
    ctx.font = dfs + "px Arial"; // Sets default size
    /*
    unnecessary code for adjusting size. Fill text has a max width property
    for (
      var fs = dfs;
      ctx.measureText(blist[k - 1]).width > barWidth * (bcst.length - 20);
      --fs
    ) {
      // shrinks default text if too large to fit
      ctx.font = fs + "px Arial";
    }*/
    ctx.fillStyle = "#ffffff";
    ctx.fillRect(0, 0, x, y); //PAINTS BACKGROUND WHITE BY DEFAULT
    ctx.fillStyle = "#000000";
    ctx.textAlign = "center";
    ctx.fillText(blist[k - 1], x / 2, dfs, x - 10); // writes the text
    // Draws each line of the barcode
    //ctx.strokeRect(0,0,x,y); //outlines barcode to make for easier cutting
    console.log(bcst);
    for (var i = 0; i < bcstd.length; ++i) {
      if (bcstd[i] == 1) {
        ctx.fillStyle = "#000000";
        ctx.fillRect(adjustedStart + i * barWidth, by, barWidth, barHeight);
      } else {
        ctx.fillStyle = "#ffffff";
        ctx.fillRect(adjustedStart + i * barWidth, by, barWidth, barHeight);
      }
    }
  }
  // printbutton.setAttribute("style", "display: inline;");
  // submitbutton.setAttribute("style", "display: none;");
  printCanvas(); // originally had seperate button for print but I don't care to see the preview.
}

function printCanvas() {
  const count = document.getElementsByClassName("barcodes").length;
  let t1;
  let t2;
  let pheight;
  let pwidth;
  let iheight;
  let iwidth;
  let grid;
  const size = document.getElementById("bcsize").value;
  const printbutton = document.getElementById("printbutton");
  const submitbutton = document.getElementById("submitbutton");
  if (size === "4x6") {
    pheight = "400px";
    pwidth = "600px";
    iheight = "400px";
    iwidth = "600px";
    grid = "grid-template-columns: 1fr;";
  } else if (size === "4x6nt") {
    pheight = "400px";
    pwidth = "600px";
    iheight = "400px";
    iwidth = "600px";
    grid = "grid-template-columns: 1fr;";
  } else if (size === "3x9nt") {
    pheight = "300px";
    pwidth = "900px";
    iheight = "300px";
    iwidth = "900px";
    grid = "grid-template-columns: 1fr;";
  } else if (size === "2x6") {
    pheight = "400px";
    pwidth = "600px";
    iheight = "200px";
    iwidth = "600px";
    grid = "grid-template-columns: 1fr;";
  } else if (size === "2x3") {
    pheight = "400px";
    pwidth = "600px";
    iheight = "200px";
    iwidth = "300px";
    grid = "grid-template-columns: 1fr 1fr;";
  } else {
    pheight = "0px";
    pwidth = "0px";
    iheight = "0px";
    iwidth = "0px";
  }

  const a = window.open("", "", "height=" + pheight + " width=" + pwidth);
  a.document.write(
    "<html><head><style>@page {size: " +
      pwidth +
      " " +
      pheight +
      "; margin: 0; padding: 0; border: 0px; overflow: hidden;} body {display:inline; margin 0;} img{margin 0; margin-left: auto; margin-right: auto; padding 0; border: 0px;} .pcontainer{display:grid; " +
      grid +
      "}</style></head>"
  ); // have to change body to inline because if you don't it prints an extra page at the start and end. This took too long to figure out.
  a.document.write('<body><div id="pcontainer">');
  for (let i = 0; i < count; ++i) {
    t1 = i + 1;
    t2 = "barcode" + t1;
    const canvas = document.getElementById(t2);
    const img = canvas.toDataURL("image/png");
    a.document.write(
      '<img src="' + img + '" width="' + iwidth + '" height="' + iheight + '"/>'
    );
  }
  a.document.write("</div></body></html>");
  a.document.close(); // stops the writing
  a.focus();
  a.onload = function () {
    a.print();
    a.close();
  };
}

//backup in case I screw up
/*function test() {
  //list of all of the modules and thier values
  var bcvalues = [
    { value: 1, character: " ", pattern: "11011001100" },
    { value: 2, character: "!", pattern: "11001101100" },
    { value: 3, character: '"', pattern: "11001100110" },
    { value: 4, character: "#", pattern: "10010011000" },
    { value: 5, character: "$", pattern: "10001001100" },
    { value: 6, character: "%", pattern: "10011001000" },
    { value: 7, character: "&", pattern: "10011000100" },
    { value: 8, character: "'", pattern: "10011000100" },
    { value: 9, character: "(", pattern: "11001001000" },
    { value: 10, character: ")", pattern: "11001000100" },
    { value: 11, character: "*", pattern: "11000100100" },
    { value: 12, character: "+", pattern: "10110011100" },
    { value: 13, character: "-", pattern: "10011011100" },
    { value: 14, character: ".", pattern: "10011001110" },
    { value: 15, character: "/", pattern: "10111001100" },
    { value: 16, character: "0", pattern: "10011101100" },
    { value: 17, character: "1", pattern: "10011100110" },
    { value: 18, character: "2", pattern: "11001110010" },
    { value: 19, character: "3", pattern: "11001011100" },
    { value: 20, character: "4", pattern: "11001001110" },
    { value: 21, character: "5", pattern: "11011100100" },
    { value: 22, character: "6", pattern: "11001110100" },
    { value: 23, character: "7", pattern: "11101101110" },
    { value: 24, character: "8", pattern: "11101001100" },
    { value: 25, character: "9", pattern: "11100101100" },
    { value: 26, character: ":", pattern: "11100100110" },
    { value: 27, character: ";", pattern: "11101100100" },
    { value: 28, character: "<", pattern: "11100110100" },
    { value: 29, character: "=", pattern: "11100110010" },
    { value: 30, character: ">", pattern: "11011011000" },
    { value: 31, character: "?", pattern: "11011000110" },
    { value: 32, character: "@", pattern: "11000110110" },
    { value: 33, character: "A", pattern: "10100011000" },
    { value: 34, character: "B", pattern: "10001011000" },
    { value: 35, character: "C", pattern: "10001000110" },
    { value: 36, character: "D", pattern: "10110001000" },
    { value: 37, character: "E", pattern: "10001101000" },
    { value: 38, character: "F", pattern: "10001100010" },
    { value: 39, character: "G", pattern: "11010001000" },
    { value: 40, character: "H", pattern: "11000101000" },
    { value: 41, character: "I", pattern: "11000100010" },
    { value: 42, character: "J", pattern: "10110111000" },
    { value: 43, character: "K", pattern: "10110001110" },
    { value: 44, character: "L", pattern: "10001101110" },
    { value: 45, character: "M", pattern: "10111011000" },
    { value: 46, character: "N", pattern: "10111000110" },
    { value: 47, character: "O", pattern: "10001110110" },
    { value: 48, character: "P", pattern: "11101110110" },
    { value: 49, character: "Q", pattern: "11010001110" },
    { value: 50, character: "R", pattern: "11000101110" },
    { value: 51, character: "S", pattern: "11011101000" },
    { value: 52, character: "T", pattern: "11011100010" },
    { value: 53, character: "U", pattern: "11011101110" },
    { value: 54, character: "V", pattern: "11101011000" },
    { value: 55, character: "W", pattern: "11101000110" },
    { value: 56, character: "X", pattern: "11100010110" },
    { value: 57, character: "Y", pattern: "11101101000" },
    { value: 58, character: "Z", pattern: "11101100010" },
    { value: 59, character: "[", pattern: "11100011010" },
    { value: 60, character: "\\", pattern: "11101111010" },
    { value: 61, character: "]", pattern: "11001000010" },
    { value: 62, character: "^", pattern: "11110001010" },
    { value: 63, character: "_", pattern: "10100110000" },
    { value: 64, character: "`", pattern: "10100001100" },
    { value: 65, character: "a", pattern: "10010110000" },
    { value: 66, character: "b", pattern: "10010000110" },
    { value: 67, character: "c", pattern: "10000101100" },
    { value: 68, character: "d", pattern: "10000100110" },
    { value: 69, character: "e", pattern: "10110010000" },
    { value: 70, character: "f", pattern: "10110000100" },
    { value: 71, character: "g", pattern: "10011010000" },
    { value: 72, character: "h", pattern: "10011000010" },
    { value: 73, character: "i", pattern: "10000110100" },
    { value: 74, character: "j", pattern: "10000110010" },
    { value: 75, character: "k", pattern: "11000010010" },
    { value: 76, character: "l", pattern: "11001010000" },
    { value: 77, character: "m", pattern: "11110111010" },
    { value: 78, character: "n", pattern: "11000010100" },
    { value: 79, character: "o", pattern: "10001111010" },
    { value: 80, character: "p", pattern: "10100111100" },
    { value: 81, character: "q", pattern: "10010111100" },
    { value: 82, character: "r", pattern: "10010011110" },
    { value: 83, character: "s", pattern: "10111100100" },
    { value: 84, character: "t", pattern: "10011110100" },
    { value: 85, character: "u", pattern: "10011110010" },
    { value: 86, character: "v", pattern: "11110100100" },
    { value: 87, character: "w", pattern: "11110010100" },
    { value: 88, character: "x", pattern: "11110010010" },
    { value: 89, character: "y", pattern: "11011011110" },
    { value: 90, character: "z", pattern: "11011110110" },
    { value: 91, character: "{", pattern: "11110110110" },
    { value: 92, character: "|", pattern: "10101111000" },
    { value: 93, character: "}", pattern: "10100011110" },
    { value: 94, character: "~", pattern: "10001011110" },
    { value: 95, character: "DEL", pattern: "10111101000" },
    { value: 96, character: "FNC 3", pattern: "10111100010" },
    { value: 97, character: "FNC 2", pattern: "11110101000" },
    { value: 98, character: "Shift A", pattern: "11110100010" },
    { value: 99, character: "Code C", pattern: "10111011110" },
    { value: 100, character: "FNC 4", pattern: "10111101110" },
    { value: 101, character: "Code A", pattern: "11101011110" },
    { value: 102, character: "FNC 1", pattern: "11110101110" },
    { value: 103, character: "Start Code A", pattern: "11010000100" },
    { value: 104, character: "Start Code B", pattern: "11010010000" },
    { value: 105, character: "Start Code C", pattern: "11010011100" },
    { value: 106, character: "Stop", pattern: "11000111010" },
    { value: 107, character: "Reverse Stop", pattern: "11010111000" },
    { value: 108, character: "Stop Pattern", pattern: "1100011101011" }
  ];
  //Calculates the check value. From https://en.wikipedia.org/wiki/Code_128 The check digit is a weighted modulo-103 checksum. It is calculated by summing the start code 'value' to the products of each symbol's 'value' multiplied by its position in the barcode string.
  var x; //barcode width
  var y; //barcode height
  var vm; //vertical margins
  var dfs; //fontsize
  var tx; //text x coordinate start
  var ty; //text x coordinate start
  var bx; // barcode x coordinate start
  var by; // barcode y coordinate start
  var b = document.getElementById("128bval").value; //pulls value from barcode text box
  var t = document.getElementById("testoutput"); //spits out text used for testing variable values during build
  var ct = document.getElementById("container"); //div container for canvases
  var bcsize = document.getElementById("bcsize").value;
  var barHeight;
  var tc; //text check if 0 then no if 1 yes;
  var blist = b.split("\n");
  var bnum;

  //sets inital values based on barcode type
  if (bcsize === "4x6") {
    x = 600;
    y = 400;
    vm = 10;
    dfs = 90;
    tx = 0;
    ty = 90;
    bx = 0;
    by = 100;
    barHeight = 300;
    tc = 1;
  } else if (bcsize === "4x6nt") {
    x = 600;
    y = 400;
    vm = 0;
    dfs = 0;
    tx = 0;
    ty = 0;
    bx = 0;
    by = 0;
    barHeight = 400;
    tc = 0;
  } else if (bcsize === "3x9nt") {
    x = 900;
    y = 300;
    vm = 0;
    dfs = 0;
    tx = 0;
    ty = 0;
    bx = 0;
    by = 0;
    barHeight = 300;
    tc = 0;
  } else if (bcsize === "2x6") {
    x = 600;
    y = 200;
    vm = 10;
    dfs = 90;
    tx = 0;
    ty = 90;
    bx = 0;
    by = 100;
    barHeight = 200;
    tc = 1;
  } else if (bcsize === "2x3") {
    x = 300;
    y = 200;
    vm = 10;
    dfs = 45;
    tx = 0;
    ty = 45;
    bx = 0;
    by = 55;
    barHeight = 145;
    tc = 1;
  } else if (bcsize === "custom") {
    x = 0;
    y = 0;
    vm = 0;
    dfs = 0;
    tx = 0;
    ty = 0;
    bx = 0;
    by = 0;
    barHeight = 0;
  } else {
    x = 0;
    y = 0;
    vm = 0;
    dfs = 0;
    tx = 0;
    ty = 0;
    bx = 0;
    by = 0;
    barHeight = 0;
    tc = 0;
  }

  //delete old canvases
  var temp2;
  var temp = document.getElementsByClassName("barcodes").length;
  for (i = temp; i > 0; --i) {
    temp2 = "barcode" + i;
    document
      .getElementById(temp2)
      .parentNode.removeChild(document.getElementById(temp2));
  }

  bnum = blist.length;
  for (k = 1; k <= bnum; ++k) {
    var bc = blist[k - 1].split(""); //takes the barcode value and splits it into an array
    var check = 103; //initializing the check value for calculation to 103 since all of the barcodes I plan to make are 128b and this is the b start code.

    var bcst = "0000000000" + bcvalues[103].pattern; //adding leading zero's/whitespace to the barcode because in order to scan it must have at least 10 leading blank spaces
    for (i = 0; i < bc.length; ++i) {
      // for each barcode character from the textbox
      for (it = 0; it < bcvalues.length; ++it) {
        //for each 128barcode value
        if (bc[i] == bcvalues[it].character) {
          //compare to see if they are the same
          check = check + bcvalues[it].value * (i + 1); //if they are the same then add to the check digit the multiple of the characters position times it's value
          bcst = bcst + bcvalues[it].pattern; //add's 1's and 0's to the pattern for coloring the barcode
        } else {
          check = check; //otherwise do nothing
        }
      }
    }
    check = check % 103; //calculating the mod of the check digit by dividing by 103.
    bcst =
      bcst + bcvalues[check].pattern + bcvalues[107].pattern + "0000000000";

    //Code for generating actual image
    //Set height and width of barcode modules
    var barWidth = Math.round(x / bcst.length);

    //create new canvas
    var ct = document.getElementById("container");
    var bcode = document.createElement("canvas");
    bcode.setAttribute("id", "barcode" + k);
    bcode.setAttribute("class", "barcodes");
    bcode.setAttribute("width", x);
    bcode.setAttribute("height", y);
    ct.append(bcode);
    var ctx = bcode.getContext("2d");

    var bcstd = bcst.split("");
    ctx.font = dfs + "px Arial"; //Sets default size
    for (
      fs = dfs;
      ctx.measureText(b).width > barWidth * (bcst.length - 20);
      --fs
    ) {
      //shrinks default text if too large to fit
      ctx.font = fs + "px Arial";
    }
    ctx.fillStyle = "#ffffff";
    ctx.fillRect(0, 0, x, y);
    ctx.fillStyle = "#000000";
    ctx.textAlign = "left";
    ctx.fillText(blist[k - 1], barWidth * 10, fs);
    //Draws each line of the barcode
    for (i = 0; i < bcstd.length; ++i) {
      if (bcstd[i] == 1) {
        ctx.fillStyle = "#000000";
        ctx.fillRect(i * barWidth, by, barWidth, barHeight);
      } else {
        ctx.fillStyle = "#ffffff";
        ctx.fillRect(i * barWidth, by, barWidth, barHeight);
      }
    }
  }

  t.innerHTML = blist[0];
}

function printCanvas() {
  var count = document.getElementsByClassName("barcodes").length;
  var t1;
  var t2;
  var pheight;
  var pwidth;
  var iheight;
  var iwidth;
  var size = document.getElementById("bcsize");
  if ( size === "4x6") {
 pheight='400px';
 pwidth='600px';
 iheight='400px';
 iwidth='600px';
  } else if ( size === "4x6nt") {
     pheight='400px';
 pwidth='600px';
 iheight='400px';
 iwidth='600px';
  } else if ( size === "3x9nt") {
     pheight='300px';
 pwidth='900px';
 iheight='300px';
 iwidth='400px';
  } else if ( size === "2x6") {
     pheight='400px';
 pwidth='600px';
 iheight='200px';
 iwidth='600px';
  } else if ( size === "2x3") {
 pheight='400px';
 pwidth='600px';
 iheight='200px';
 iwidth='300px';
  }
  else { 
 pheight='0px';
 pwidth='0px';
 iheight='0px';
 iwidth='0px';}
  
  var a = window.open("", "", "height="+pheight", width="+pwidth);
  a.document.write("<html><head><style>@page {size: "+pwidth+" "+pheight+"; margin: 0; padding: 0; border: 0px; overflow: hidden;} body {display:inline;}</style></head>");//have to change body to block because if you don't it prints an extra page at the start and end. This took too long to figure out.
  a.document.write('<body>');
  for (i = 0; i < count; ++i) {
    t1 = i + 1;
    t2 = "barcode" + t1;
    var canvas = document.getElementById(t2);
    var img = canvas.toDataURL("image/png");
    a.document.write('<img src="' + img + '" width="'+iwidth+'" height="'+iheight+'" />');
  }
  a.document.write("</body></html>");
  a.document.close();//stops the writing
  a.focus();
  a.onload = function(){a.print();}//
}


*/

  </script>