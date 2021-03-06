
    

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>

         

          <div class="row">
          	<div class="col-lg">
              <?php if (validation_errors()): ?>
                <div class="alert alert-danger " role="alert">
                   <?php echo validation_errors(); ?>
                </div>
              <?php endif; ?>
          		 
          		 <?php echo $this->session->flashdata('message'); ?>
          		<a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">Add New Menu</a>

          		<table class="table table-hover">
          			<thead>
          				<tr>
          					<th scope="col">#</th>
          					<th scope="col">menu</th>
          					<th scope="col">title</th>
                    <th scope="col">url</th>
                    <th scope="col">icon</th>
                    <th scope="col">active</th>
                    <th scope="col">action</th>
          				</tr>
          			</thead>
          			<tbody>
          				<?php $i =1; ?>
          				<?php foreach ($submenu as $sm): ?>
          					<tr>
	          					<th scope="row"><?php echo $i; ?></th>
	          					<td><?php echo $sm['menu'] ?></td>
                      <td><?php echo $sm['title'] ?></td>
                      <td><?php echo $sm['url'] ?></td>
                      <td><?php echo $sm['icon'] ?></td>
                      <td><?php echo $sm['is_active'] ?></td>
	          					<td>
	          						<a href="" class="badge badge-success">edit</a>
	          						<a href="" class="badge badge-danger">delet</a>
	          					</td>
          					</tr>
          					<?php $i++ ?>
          				<?php endforeach; ?>
          				
          			</tbody>
          		</table>
          	</div>
          </div>
         

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

<!-- Modal -->
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="exampleModalLabel">Add new sub menu</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <form action="<?php echo base_url('menu/submenu'); ?> "method="post" >
				    <div class="modal-body">
					    <div class="form-group">
							  <input type="text" class="form-control" id="title" name="title" placeholder="submenu title">
	  					</div>
              <div class="form-group">
                <select name="menu_id" id="menu_id" class="form-control">
                  <option value="">select menu</option>
                  <?php foreach ($menu as $m): ?>
                    <option value="<?php echo $m['id']; ?>"><?php echo $m['menu']; ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group">
                <input type="text" class="form-control" id="url" name="url" placeholder="url">
              </div>
              <div class="form-group">
                <input type="text" class="form-control" id="icon" name="icon" placeholder="icon">
              </div>
              <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                    <label class="form-check-label" for="is_active">
                      active
                    </label>
                </div>
              </div>
				    </div>
				    <div class="modal-footer">
				        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				        <button type="submit" class="btn btn-primary">Add</button>
				    </div>
		  	 	</form>
		    </div>
		  </div>
		</div>

      
