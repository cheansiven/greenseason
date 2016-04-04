<?php include_once('application/views/admin/header.php'); ?>

<!-- MAIN CONTENT -->
<div class="container">
  <a href=""<?php echo site_url("admin/articles/");?>"" class="btn btn-default active-tab dashboard-tab">Dashboard</a>
  <a href="<?php echo site_url("admin/articles/add");?>" class="btn btn-primary">Add new article</a>
</div>

<div id="content" class="container">
  <div class="page-full-width cf">
    <div class="content-module">
      <div class="content-module-heading cf">
        <h3 class="fl">ARTICLE</h3>
      </div>
      <!-- end content-module-heading -->
      
      <div class="content-module-main">
        <a href="#">Found <span class="badge"><?php echo $num_results; ?></span></a>
          <?= form_open_multipart('admin/articles/ordering','id="regionForm" name="regionForm"'); ?>
        <table class="table">
          <thead>
            <tr>

                <th><a href="<?= base_url().'admin/articles/index/order/id/sort/'.$sort[7].'/'.$this->uri->segment(7); ?>">ID</a> <i class="fa <?php if ($sort[5] == "id" && $sort[7] == "desc") { echo "fa-sort-desc"; } elseif($sort[5] == "id" && $sort[7] == "asc") { echo "fa-sort-asc"; } else { echo "fa-sort"; } ?>"></i></th>
                <th><a href="<?= base_url().'admin/articles/index/order/title/sort/'.$sort[7].'/'.$this->uri->segment(7); ?>">Type</a> <i class="fa <?php if ($sort[5] == "title" && $sort[7] == "desc") { echo "fa-sort-desc"; } elseif($sort[5] == "title" && $sort[7] == "asc") { echo "fa-sort-asc"; } else { echo "fa-sort"; } ?>"></i></th>
              <th>Sub Title</th>
              <th><a href="<?= base_url().'admin/articles/index/order/category/sort/'.$sort[7].'/'.$this->uri->segment(7); ?>">Category Name [ Type ]</a> <i class="fa <?php if ($sort[5] == "category" && $sort[8] == "desc") { echo "fa-sort-desc"; } elseif($sort[5] == "category" && $sort[7] == "asc") { echo "fa-sort-asc"; } else { echo "fa-sort"; } ?>"></i></th>
                <th><input type="submit" name="order" value="Ordering"></th>
              <th>Active</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <td colspan="5" class="table-footer"><?php if (strlen($links)): ?>
                Pages: <?php echo $links; ?>
                <?php endif; ?></td>
            </tr>
          </tfoot>
          <tbody>
            <?php foreach($articles as $article):

                $type = "";
                if( $article->category_type == 1 )
                    $type = "[ Slide Content Block ]";
                elseif ( $article->category_type == 2 )
                    $type = "[ Extra Block ]";

                echo '
                <tr>
                    <td>'.$article->id.'</td>
                    <td><a href="'.site_url("admin/articles/edit?id=$article->id").'">'.$article->title.'</a></td>
                    <td>'.$article->sub_title.'</td>
                    <td>'.$article->category_name.' '.$type.'</td>';
                echo '<td>'.form_input('orders['.$article->id.']',$article->ordering, 'class="small-width-input" autofocus').'</td><td>';
                echo $article->active == '1'?'Yes':'No';
                echo '</td>
                    <td>
                        <a href="'.site_url("admin/articles/edit?id=$article->id").'" class="table-actions-button ic-table-edit text-primary fa fa-pencil-square-o"></a>
                        <a onClick="return window.confirm(\'Delete '.$article->title.'?\');" href="'.site_url("admin/articles/delete?id=$article->id").'" class="text-danger fa fa-trash-o table-actions-button ic-table-delete"></a>
                    </td>
                </tr>
                ';

                endforeach; ?>
          </tbody>
          <?= form_close() ?>
        </table>
      </div>
      <!-- end content-module-main --> 
      
    </div>
    <!-- end content-module --> 
    
  </div>
  <!-- end full-width --> 
  
</div>
<!-- end content --> 

<!-- FOOTER -->
<?php include_once('application/views/admin/footer.php'); ?>
<!-- end footer -->

</body>
</html>