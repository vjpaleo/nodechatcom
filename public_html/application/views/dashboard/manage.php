<h1 class="page-header">Dashboard</h1>

    <div class="row placeholders">
      <div class="col-xs-6 col-sm-3 placeholder">
        <h4>My Chat Groups</h4>
        <span class="text-muted">The chat groups created by me.</span>
      </div>
      <div class="col-xs-6 col-sm-3 placeholder">
        <h4>My Friends</h4>
        <span class="text-muted">My friend list.</span>
      </div>
      <div class="col-xs-6 col-sm-3 placeholder">
        <h4>My Profile</h4>
        <span class="text-muted">View and edit profile.</span>
      </div>
      <div class="col-xs-6 col-sm-3 placeholder">
        <h4>Settings</h4>
        <span class="text-muted">General and privacy settings.</span>
      </div>
    </div>
    <?php
    /* load common chat component */
    $this->load->view('dashboard/common_chatbox');
    ?>
         
            