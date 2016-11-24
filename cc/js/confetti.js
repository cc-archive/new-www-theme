  var utils = {
    norm: function(value, min, max) {
      return (value - min) / (max - min);
    },

    lerp: function(norm, min, max) {
      return (max - min) * norm + min;
    },

    map: function(value, sourceMin, sourceMax, destMin, destMax) {
      return utils.lerp(utils.norm(value, sourceMin, sourceMax), destMin, destMax);
    },

    clamp: function(value, min, max) {
      return Math.min(Math.max(value, Math.min(min, max)), Math.max(min, max));
    },

    distance: function(p0, p1) {
      var dx = p1.x - p0.x,
        dy = p1.y - p0.y;
      return Math.sqrt(dx * dx + dy * dy);
    },

    distanceXY: function(x0, y0, x1, y1) {
      var dx = x1 - x0,
        dy = y1 - y0;
      return Math.sqrt(dx * dx + dy * dy);
    },

    circleCollision: function(c0, c1) {
      return utils.distance(c0, c1) <= c0.radius + c1.radius;
    },

    circlePointCollision: function(x, y, circle) {
      return utils.distanceXY(x, y, circle.x, circle.y) < circle.radius;
    },

    pointInRect: function(x, y, rect) {
      return utils.inRange(x, rect.x, rect.x + rect.width) &&
        utils.inRange(y, rect.y, rect.y + rect.height);
    },

    inRange: function(value, min, max) {
      return value >= Math.min(min, max) && value <= Math.max(min, max);
    },

    rangeIntersect: function(min0, max0, min1, max1) {
      return Math.max(min0, max0) >= Math.min(min1, max1) &&
        Math.min(min0, max0) <= Math.max(min1, max1);
    },

    rectIntersect: function(r0, r1) {
      return utils.rangeIntersect(r0.x, r0.x + r0.width, r1.x, r1.x + r1.width) &&
        utils.rangeIntersect(r0.y, r0.y + r0.height, r1.y, r1.y + r1.height);
    },

    degreesToRads: function(degrees) {
      return degrees / 180 * Math.PI;
    },

    radsToDegrees: function(radians) {
      return radians * 180 / Math.PI;
    },

    randomRange: function(min, max) {
      return min + Math.random() * (max - min);
    },

    randomInt: function(min, max) {
      return Math.floor(min + Math.random() * (max - min + 1));
    }

  }

  // 1. number
  // 2. gravity
  // 3. friction
  // 4. wind
  element1 = {value: 200};
  element2 = {value : .1};
  element3 = {value : .99};
  element4 = {value : 0};

  canvas = document.getElementById("confetti-canvas");

  var context = canvas.getContext('2d');
  W = canvas.width = window.innerWidth;
  H = canvas.height = window.innerHeight;
  generatorStock = [];

  gravity = parseFloat(element2.value);

  friction = element3.value;
  wind = element4.value;
  colors = [
    '#f44336', '#e91e63', '#9c27b0', '#673ab7',
    '#03a9f4', '#00bcd4', '#009688', '#4CAF50',
    '#8BC34A', '#CDDC39', '#FFEB3B', '#FFC107', '#FF9800',
    '#FF5722'
  ];

  generator1 = new particleGenerator(0, 0, W, 0, element1.value);

  function loadImage(url) {
    var img = document.createElement("img");
    img.src = url;
    return img;
  }

  var mouse = {
    x: 0,
    y: 0
  };
  canvas.addEventListener('mousemove', function(e) {
    mouse.x = e.pageX - this.offsetLeft;
    mouse.y = e.pageY - this.offsetTop;
  }, false);

  function randomInt(min, max) {
    return min + Math.random() * (max - min);
  }

  function clamp(value, min, max) {
    return Math.min(Math.max(value, Math.min(min, max)), Math.max(min, max));
  }

  function particle(x, y) {
    this.radius = randomInt(.1, 1);
    this.x = x;
    this.y = y;
    this.vx = randomInt(-4, 4);
    this.vy = randomInt(-10, -0);
    // Set the shape.
    this.type = 1;

    this.w = utils.randomRange(5, 20);
    this.h = utils.randomRange(5, 20);

    this.r = utils.randomRange(5, 10);

    this.angle = utils.degreesToRads(randomInt(0, 360));
    this.anglespin = randomInt(-0.2, 0.2);
    this.color = colors[Math.floor(Math.random() * colors.length)];

    this.rotateY = randomInt(0, 1);

  }

  particle.prototype.update = function() {
    this.x += this.vx;
    this.y += this.vy;
    this.vy += gravity;
    this.vx += wind;
    this.vx *= friction;
    this.vy *= friction;
    this.radius -= .02;

    if (this.rotateY < 1) {
      this.rotateY += 0.1;

    } else {
      this.rotateY = -1;

    }
    this.angle += this.anglespin;

    context.save();
    context.translate(this.x, this.y);
    context.rotate(this.angle);

    context.scale(1, this.rotateY);

    context.rotate(this.angle);
    context.beginPath();
    context.fillStyle = this.color;
    context.strokeStyle = this.color;
    context.lineCap="round";
    context.lineWidth = 2;


    if (this.type === 0) {
      // Circles
      context.beginPath();
      context.arc(0, 0, this.r, 0, 2 * Math.PI);
      context.fill();
    } else if (this.type === 2){
      // Swirlies!
      context.beginPath();

      for (i = 0; i < 22; i++) {
          angle = 0.5 * i;
          x = (.2 + 1.5 * angle) * Math.cos(angle);
          y =(.2 + 1.5 * angle) * Math.sin(angle);

          context.lineTo(x, y);
      }
      context.stroke();
    } else if (this.type === 1){
      // Rectagles
      context.fillRect(-this.w / 2, -this.h / 2, this.w, this.h);
    }

    context.closePath();
    context.restore();

  }

  function particleGenerator(x, y, w, h, number, text) {
    // particle will spawn in this aera
    this.x = x;
    this.y = y;
    this.w = w;
    this.h = h;
    this.number = number;
    this.particles = [];
    this.text = text;
    this.recycle = true;
    // 0 = fountain
    // 1 = falling
    this.type=1;
  }
  particleGenerator.prototype.animate = function() {

    context.fillStyle = "grey";

    context.beginPath();
    context.strokeRect(this.x, this.y, this.w, this.h);

    context.font = "13px arial";
    context.textAlign = "center";

    context.closePath();
//     for (var i = 0; i < 100; i++) {

    if (this.particles.length < this.number) {
      this.particles.push(new particle(clamp(randomInt(this.x, this.w + this.x), this.x, this.w + this.x),

        clamp(randomInt(this.y, this.h + this.y), this.y, this.h + this.y), this.text));
    }

    if (this.particles.length > this.number) {
      this.particles.length = this.number;
    }

    for (var i = 0; i < this.particles.length; i++) {
      p = this.particles[i];
      p.update();
      if (p.y > H || p.y < -100 || p.x > W+100 || p.x < -100&& this.recycle) {
        //a brand new particle replacing the dead one
        this.particles[i] = new particle(clamp(randomInt(this.x, this.w + this.x), this.x, this.w + this.x),

          clamp(randomInt(this.y, this.h + this.y), this.y, this.h + this.y), this.text);
      }
    }
  }
toggleEngine();

  function toggleEngine(){
if(generator1.type ===0){
  generator1.type =1;
    generator1.x =W/2;
    generator1.y =H/2;
    generator1.w =0;

}else{
generator1.type =0;
      generator1.x =1;
      generator1.w =W;
    generator1.y =0;

}

}
  
  update();

  function update() {

    gravity = parseFloat(element2.value);
    generator1.number = element1.value;
    friction = element3.value;
    wind = parseFloat(element4.value);

    context.fillStyle="white";    context.clearRect(0, 0, W, H);
    generator1.animate();
    requestAnimationFrame(update);

  }