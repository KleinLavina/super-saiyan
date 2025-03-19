<style>
  :root {
  font-size: 125%;
}

*,
*:before,
*:after {
  box-sizing: border-box;
}

.alt-body {
  font: 1em/1.618 Inter, sans-serif;
  margin: 0;
  color: #224;
  background:
    url('images/backshot.jpg')
    center / cover no-repeat fixed;
}

.par {
  margin: 0;
}

.par:not(:last-child) {
  margin-bottom: 1.5em;
}

.site-container {
  display: grid;
  place-items: center;
  
  min-height: 80vh;
  padding: 1.5em;
}


.card {
  max-width: 300px;
  min-height: 200px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;

  max-width: 500px;
  height: 300px;
  padding: 35px;

  border: 1px solid rgba(255, 255, 255, .25);
  border-radius: 20px;
  background-color: rgba(255, 255, 255, 0.45);
  box-shadow: 0 0 10px 1px rgba(0, 0, 0, 0.25);

  backdrop-filter: blur(15px);
}

.card-footer {
  font-size: 0.65em;
  color: #446;
}


</style>
<div class="alt-body">
<div class="site-container">

  <div class="card">
    <div class="par">A glass-like card to demonstrate the <strong>Glassmorphism UI design</strong> trend.</p>
    <div class="card-footer">Created by Rahul C.</p>
  </div>

</div>
</div>