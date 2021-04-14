<!-- product image -->
<!-- Use the color picker or change the final 000000 value to any hex value to dynamically update the car color.-->

<img id="productImage" src="https://ddools.imgix.net/cars/base.png?w=600&mark-align=center,middle&mark=https%3A%2F%2Fddools.imgix.net%2Fcars%2Fpaint.png%3Fw%3D600%26bri%3D-18%26con%3D26%26monochrome%3D000000" alt="my base image" />




<!-- Colour picker -->
<div class="colors">
  <div class="color" style="background-color: #000000" data-hex="000000"></div>
  <div class="color" style="background-color: #0d4671" data-hex="0d4671"></div>
  <div class="color" style="background-color: #63803a" data-hex="63803a"></div>
  <div class="color" style="background-color: #841210" data-hex="841210"></div>
   <div class="color" style="background-color: #a09e9f" data-hex="none"></div>
   <input id="customColour" class="color jscolor" onchange="update(this.jscolor)"  data-hex="" />
</div>

<style>
/* Colour picker css only */

.colors {
  display: flex;
  position: fixed;
  bottom: 2em;
  right: 2em;
}

.color {
  height: 36px;
  width: 36px;
  margin-left: 0.5em;
  border-radius: 18px;
  box-shadow: 0px 4px 10px rgba(0,0,0,0.3);
  border: 2px solid #aaa;
  cursor: pointer;
}
</style>

<script>
    // Colour picker JS only

// Reference of base image with paint watermark
const base = "https://ddools.imgix.net/cars/base.png?w=600&mark-align=center,middle&mark=https%3A%2F%2Fddools.imgix.net%2Fcars%2Fpaint.png%3Fw%3D600%26bri%3D-18%26con%3D26%26monochrome%3D"

// Click on a color
var el = document.getElementsByClassName("color");
for (var i = 0; i < el.length; i++) {
  el[i].onclick = changeColor;
}

function changeColor(e) {
  // get the hex color
  let hex = e.target.getAttribute("data-hex");
  // updated url
  let updateColor = base + hex;
  // update src of image
  document.getElementById("productImage").src = updateColor;

  
}

//http://jscolor.com
//Custom colourpicker
function update(jscolor) {
  let updateColor = base + jscolor;
    // Use 'jscolor' instance for car color
     document.getElementById("productImage").src = updateColor;
}
</script>