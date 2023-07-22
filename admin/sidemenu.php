<!--Main Navigation-->
<header>
  <!-- Sidebar -->
  <nav id="sidebarMenu" class="collapse d-lg-block sidebar collapse bg-white">
    <div class="position-sticky">
      <div class="list-group list-group-flush mx-3 mt-4">
        <a href="index.php" class="list-group-item list-group-item-action py-2 ripple" aria-current="true">
          <span>Main dashboard</span>
        </a>
        <a href="index.php" class="list-group-item list-group-item-action py-2 ripple">
          <span>Orders</span>
        </a>
        <a href="products.php" class="list-group-item list-group-item-action py-2 ripple"><span>Products</span></a>
        <a href="register.php" class="list-group-item list-group-item-action py-2 ripple"><span>Add Account</span></a>
        <a href="accounts.php" class="list-group-item list-group-item-action py-2 ripple">
          <span>Accounts</span>
        </a>
      </div>
    </div>
  </nav>

<!--Main layout-->
<main style="margin-top: 58px;">
  <div class="container pt-4"></div>
</main>
<!--Main layout-->
<style>
    body {
background-color: #fbfbfb;
}
@media (min-width: 991.98px) {
main {
padding-left: 240px;
}
}

/* Sidebar */
.sidebar {
position: fixed;
top: 0;
bottom: 0;
left: 0;
padding: 58px 0 0; /* Height of navbar */
box-shadow: 0 2px 5px 0 rgb(0 0 0 / 5%), 0 2px 10px 0 rgb(0 0 0 / 5%);
width: 240px;
z-index: 600;
}

@media (max-width: 991.98px) {
.sidebar {
width: 100%;
}
}
.sidebar .active {
border-radius: 5px;
box-shadow: 0 2px 5px 0 rgb(0 0 0 / 16%), 0 2px 10px 0 rgb(0 0 0 / 12%);
}

.sidebar-sticky {
position: relative;
top: 0;
height: calc(100vh - 48px);
padding-top: 0.5rem;
overflow-x: hidden;
overflow-y: auto; /* Scrollable contents if viewport is shorter than content. */
}
</style>