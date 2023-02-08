<div id="content" class="p-4 p-md-5">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    
  <?php
                $session = $this->getRequest()->getSession();
                echo "<h2>Welcome!_</h2>"."<h3>".$result->email."</h3>";
            ?>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="nav navbar-nav ml-auto">
        <li class="nav-item active">
            <a class="nav-link" href="/Users/template">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/Users/logout">Logout</a>
        </li>
       
      </ul>
    </div>
  </div>
</nav>
