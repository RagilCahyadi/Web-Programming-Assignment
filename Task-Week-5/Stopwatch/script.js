const canvas = document.getElementById("canvas-stopwatch");
const ctx = canvas.getContext("2d");

let startTime = null;
let elapsedTime = 0;
let timerInterval = null;
let hoveredButton = null;


// Time Display Function
function drawTime() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);
  let time = elapsedTime;

  const hours = Math.floor(time / (1000 * 60 * 60));
  time %= 3600000;
  const minutes = Math.floor(time / (1000 * 60));
  time %= 60000;
  const seconds = Math.floor(time / 1000);
  const milliseconds = Math.floor((time % 1000) / 10);

  const h = hours.toString().padStart(2, '0');
  const m = minutes.toString().padStart(2, '0');
  const s = seconds.toString().padStart(2, '0');
  const ms = milliseconds.toString().padStart(2, '0');

  ctx.font = "bold 64px Arial";
  ctx.textAlign = "center";
  ctx.textBaseline = "middle";
  
  const centerY = 170;
  const centerX = canvas.width / 2;

  const timeString = `${h}:${m}:${s}:${ms}`;
  const timeWidth = ctx.measureText(timeString).width;
  
  let x = centerX - timeWidth / 2;
  
  ctx.fillStyle = "blue";
  ctx.textAlign = "left";
  let hourWidth = ctx.measureText(h).width;
  ctx.fillText(h, x, centerY);
  x += hourWidth;

  ctx.fillStyle = "black";
  let colonWidth = ctx.measureText(':').width;
  ctx.fillText(':', x, centerY);
  x += colonWidth;
  
  ctx.fillStyle = "gold";
  let minuteWidth = ctx.measureText(m).width;
  ctx.fillText(m, x, centerY);
  x += minuteWidth;

  ctx.fillStyle = "black";
  ctx.fillText(':', x, centerY);
  x += colonWidth;
  
  ctx.fillStyle = "green";
  let secondWidth = ctx.measureText(s).width;
  ctx.fillText(s, x, centerY);
  x += secondWidth;
  
  ctx.fillStyle = "black";
  ctx.fillText(':', x, centerY);
  x += colonWidth;
  
  ctx.fillStyle = "red";
  ctx.fillText(ms, x, centerY);

  drawButtons();
}

function startTimer() {
  if (!timerInterval) {
    startTime = Date.now() - elapsedTime;
    timerInterval = setInterval(() => {
      elapsedTime = Date.now() - startTime;
      drawTime();
    }, 10);
  }
}

function stopTimer() {
  clearInterval(timerInterval);
  timerInterval = null;
}

function resetTimer() {
  stopTimer();
  elapsedTime = 0;
  drawTime();
}


// Button Function
const buttons = [
  { id: "startBtn", text: "Start", x: 175, y: 220, width: 110, height: 40, radius: 10, 
    color: "green", hoverColor: "darkgreen", textColor: "white", hoverTextColor: "white" },
  { id: "stopBtn", text: "Stop", x: 295, y: 220, width: 110, height: 40, radius: 10, 
    color: "yellow", hoverColor: "#e6e600", textColor: "black", hoverTextColor: "black" },
  { id: "resetBtn", text: "Reset", x: 415, y: 220, width: 110, height: 40, radius: 10, 
    color: "red", hoverColor: "darkred", textColor: "white", hoverTextColor: "white" }
];

function drawRoundedButton(ctx, button, isHovered) {
  const { x, y, width, height, radius, text } = button;
  const color = isHovered ? button.hoverColor : button.color;
  const textColor = isHovered ? button.hoverTextColor : button.textColor;
  
  ctx.beginPath();
  ctx.moveTo(x + radius, y);
  ctx.lineTo(x + width - radius, y);
  ctx.arcTo(x + width, y, x + width, y + radius, radius);
  ctx.lineTo(x + width, y + height - radius);
  ctx.arcTo(x + width, y + height, x + width - radius, y + height, radius);
  ctx.lineTo(x + radius, y + height);
  ctx.arcTo(x, y + height, x, y + radius, radius);
  ctx.lineTo(x, y + radius);
  ctx.arcTo(x, y, x + radius, y, radius);
  ctx.closePath();

  ctx.font = "bold 24px Montserrat";
  ctx.fillStyle = color;
  ctx.fill();
  
  ctx.fillStyle = textColor;
  ctx.textAlign = "center";
  ctx.textBaseline = "middle";
  ctx.fillText(text, x + width/2, y + height/2);
}

function drawButtons() {
  buttons.forEach(button => {
      drawRoundedButton(ctx, button, button === hoveredButton);
  });
}

canvas.addEventListener('mousemove', (e) => {
  const rect = canvas.getBoundingClientRect();
  const mouseX = e.clientX - rect.left;
  const mouseY = e.clientY - rect.top;
  
  let foundHover = null;
  for (const button of buttons) {
      if (
          mouseX >= button.x && 
          mouseX <= button.x + button.width && 
          mouseY >= button.y && 
          mouseY <= button.y + button.height
      ) {
          foundHover = button;
          canvas.style.cursor = 'pointer';
          break;
      }
  }
  
  if (!foundHover) {
      canvas.style.cursor = 'default';
  }
  
  if (foundHover !== hoveredButton) {
      hoveredButton = foundHover;
      drawTime();
  }
});

canvas.addEventListener('click', (e) => {
  const rect = canvas.getBoundingClientRect();
  const mouseX = e.clientX - rect.left;
  const mouseY = e.clientY - rect.top;
  
  // Check which button was clicked
  for (const button of buttons) {
      if (
          mouseX >= button.x && 
          mouseX <= button.x + button.width && 
          mouseY >= button.y && 
          mouseY <= button.y + button.height
      ) {
          if (button.id === "startBtn") startTimer();
          else if (button.id === "stopBtn") stopTimer();
          else if (button.id === "resetBtn") resetTimer();
          break;
      }
  }
});

drawTime();