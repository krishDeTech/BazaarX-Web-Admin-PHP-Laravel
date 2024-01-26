<body>
<style>
.container {
    background-color: #fff;
    padding: 20px;
    
}
.container div {
    width: 100px;
    height: 50px;
    display: inline-block;
    color: #fff;
    text-align: center;
    padding-top: 30px;

}

.AAA { background: #4E62F7; }
.BBB { background: #BEBFBA; }
.CCC { background: #FC7864; }

@media screen and (max-width: 531px) {
    .container { 
      display: flex; 
      flex-flow: column; 
    }
    .CCC { 
      order: 1; 
    }
    .AAA { 
      order: 2; 
    }
    .BBB { 
      order: 3 
    }
}
</style>
<h1>Resize to change div order</h1>
<div class="container">
    <div class="AAA">AAA</div>
    <div class="BBB">BBB</div>
    <div class="CCC">CCC</div>
</div>
