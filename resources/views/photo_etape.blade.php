@extends('layout.index')
@section('content')

<style>
    .a-img-txt{
      display:grid; 
    }
    
    /* les enfants se superposent */
    .a-img-txt>*{
      grid-area:1/1/-1/-1; 
      /* raccourci pour grid-row et grid-column */
    }
    .a-img{
      filter:invert(1);
    }
    /* le texte */
    .a-txt{
      display:flex;
      justify-content:center;
      align-items:center;
      color:#fff;
      opacity:0;
      filter:invert(0); /* antibug si effet sur a-img */
      transition:opacity .8s;
    }
    
    /* les couleurs c1 et c2 */
    .c1{
        background:#ff6600cc; /* avec alpha */
    }
    
    .c2{
        background:#6600ffcc; /* avec alpha */
    }
    
    /* le survol */
    .a-txt:hover{
      opacity:1;
    }
    .a-img-txt:hover .a-img{
      filter:invert(0);
    }
    /* la déco */
    body{
      margin:24px;
      font-family:sans-serif;
      font-size:21px;
      display:grid;
      grid-template-columns:1fr 1fr;
      grid-gap:10px;
      gap:24px;
    }
    
    img{
      max-width:100%;
      height:auto;
    }
    a{
      text-decoration:none;
    }
      </style>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
<a class="a-img-txt" href="https://jenseign.com">
    <img class="a-img" src="https://jenseign.com/html/wp-content/uploads/2016/07/microscope.png"  alt="jenseign">
    <span class="a-txt c1">jenseign.com</span>
  </a>
  
  <a class="a-img-txt" href="https://jaiunsite.com">
    <img class="a-img" src="https://jenseign.com/html/wp-content/uploads/2016/07/tools-1.png" alt="jenseign">
    <span class="a-txt c2">jaiunsite.com</span>
  </a>

</body>
</html>


 
@endsection