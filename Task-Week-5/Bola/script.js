// script.js
const canvas = document.getElementById("canvas");
const ctx = canvas.getContext("2d");

const radius = 15; 
let x = 0;
let y = canvas.height / 2;
let dx = 5;
let dy = 5;
let direction = "right";

function drawBall() {
  ctx.beginPath();
  ctx.arc(x, y, radius, 0, Math.PI * 2);
  ctx.fillStyle = "white";
  ctx.fill();
  ctx.closePath();
}

function clear() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);
}

function animate() {
  clear();
  drawBall();

  if (direction === "right") {
    x += dx;
    if (x + radius > canvas.width) {
      direction = "down";
    }
  } else if (direction === "down") {
    y += dy;
    if (y + radius >= canvas.height) {
      direction = "left";
    }
  } else if (direction === "left") {
    x -= dx;
    if (x + radius < 0) {
      cancelAnimationFrame(anim);
      return; 
    }
  }

  anim = requestAnimationFrame(animate);
}

let anim = requestAnimationFrame(animate);
