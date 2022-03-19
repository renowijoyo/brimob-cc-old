<!DOCTYPE html>
<html>
  <head>
    <?php $this->load->view('templates/head.php', array('title'=>'Login SCC')); ?>
    <style>
      body { background-color: #1E034E; }
      .centery {
        margin-top:100px; margin-bottom: auto;
      }
    </style>
  </head>
  <body>
    <div class="container centery">
      <div class="row vertical-offset-100">
        <div class="col-md-4 col-md-offset-4">
        	<div class="panel panel-default">
    			  <div class="panel-heading">
    			    <h3 class="panel-title" style="color:white">Please sign in to SCC</h3>
    			 	</div>
    			  <div class="panel-body">
    			   	<form accept-charset="UTF-8" role="form" action="<?=base_url()?>login" method="post">
                <fieldset>
    			   	  	<div class="form-group">
    			   		    <input class="form-control" placeholder="username" name="username" type="text">
    			    		</div>
    			    		<div class="form-group">
    			    			<input class="form-control" placeholder="password" name="password" type="password" value="">
    			    		</div>
                  <div class="form-group">
                    <?php if(isset($loginMessage)): ?>
                      <p class="text-danger"><?=$loginMessage?></p>
                    <?php endif; ?>
                  </div>
    			    		<input class="btn btn-lg btn-info btn-block" type="submit" value="Login">
    			    	</fieldset>
    			    </form>
    			  </div>
    		  </div>
    	  </div>
      </div>
    </div>
    <?php require 'templates/foot.php'; ?>
  </body>
</html>
