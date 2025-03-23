<div class="container">
<h1><span>Men</span> & <span>Women Jackets</span></h1>
  <div class="gallery">
    <img src="images/mene.jpg" alt="Men Jacket">
    <img src="images/womene.jpg" alt="Women Jacket">
  </div>
</div>

<style>
    h1 span:first-child {
  color: #0b3fa1; /* Blue */
}

/* Style second span (Women Jackets) */
h1 span:last-child {
    color: #af3817; /* Red */
}
    .container {
  display: flex;
  flex-direction: column;
  justify-content: center; /* Center vertically */
  align-items: center; /* Center horizontally */
  height: 100vh; /* Full viewport height */
}

  .gallery {
  --z: 32px;  /* control the zig-zag  */
  --s: 400px; /* control the size */
  --g: 8px;   /* control the gap */
  
  display: grid;
  gap: var(--g);
  width: calc(2*var(--s) + var(--g));
  grid-auto-flow: column;
}
.gallery > img {
  width: 0;
  min-width: calc(100% + var(--z)/2);
  height: var(--s);
  object-fit: cover;
  -webkit-mask: var(--mask);
          mask: var(--mask);
  cursor: pointer;
  transition: .5s;
}
.gallery > img:hover {
  width: calc(var(--s)/2);
}
.gallery > img:first-child {
  place-self: start;
  clip-path: polygon(calc(2*var(--z)) 0,100% 0,100% 100%,0 100%);
  --mask: 
    conic-gradient(from -135deg at right,#0000,#000 1deg 89deg,#0000 90deg) 
      50%/100% calc(2*var(--z)) repeat-y;
}
.gallery > img:last-child {
  place-self: end;
  clip-path: polygon(0 0,100% 0,calc(100% - 2*var(--z)) 100%,0 100%);
  --mask: 
    conic-gradient(from   45deg at left ,#0000,#000 1deg 89deg,#0000 90deg) 
      50% calc(50% - var(--z))/100% calc(2*var(--z)) repeat-y;
}

body {
  margin: 0;
  display: grid;
  place-content: center;
  background: #A8DBA8;
  animation: changeBackground 6s infinite alternate;
}
@keyframes changeBackground {
  0% { background: #A8DBA8; filter: brightness(0.7); } /* Green */
  33% { background: #FFDD57;filter: brightness(0.7); } /* Yellow */
  66% { background:rgb(145, 247, 108); filter: brightness(0.7);} /* Red */
  100% { background:rgb(171, 213, 18); filter: brightness(0.7);} /* Blue */
}
h1 {
  text-align: center;
  
  font-size: 3rem;
  
}
h1 span:first-child {
  color: #af3817;
}
h1 span:last-child {
  color: #0b3fa1;
}
</style>