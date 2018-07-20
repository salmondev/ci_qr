<head>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet"/>
<link href="https://cdn.datatables.net/buttons/1.2.4/css/buttons.dataTables.min.css" rel="stylesheet"/>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.18/pdfmake.min.js"></script>

<script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.bootstrap.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.html5.js"></script>
<script src="https://cdn.datatables.net/buttons/1.2.4/js/buttons.print.js"></script>
<script src="<?php echo base_url('src/excelexportjs.js');?>"></script>

<script type="text/javascript" src="//unpkg.com/xlsx/dist/shim.min.js"></script>
<script type="text/javascript" src="//unpkg.com/xlsx/dist/xlsx.full.min.js"></script>

<script type="text/javascript" src="//unpkg.com/blob.js@1.0.1/Blob.js"></script>
<script type="text/javascript" src="//unpkg.com/file-saver@1.3.3/FileSaver.js"></script>


<style>
.exportExcel{
  padding: 5px;
  border: 1px solid grey;
  margin: 5px;
  cursor: pointer;
}
</style>
</head>

<div class="row">
    <div class="col-md-12">
    <div class="box">
            <div class="box-header">
              <!-- <h3 class="box-title">Tb Item Listing</h3> -->
              <div class="box-title">
                    <a href="<?php echo site_url('tb_item/add'); ?>" class="btn btn-success ">ADD ITEM</a> 
                    </br></br>
                    <p id="xportxlsx" class="xport"><input type="submit" value="EXPORT" class="btn btn-warning" onclick="doit('xlsx');"></p>


                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Detail</th>
                  <th>Date</th>
                  <!--<th>Actions</th>-->
                </tr>
                </thead>

                
                <?php foreach($tb_item as $t){ ?>
                    <tr>
						<td><?php echo $t['id']; ?></td>
						<td><?php echo $t['name']; ?></td>
						<td><?php echo $t['detail']; ?></td>
						<td><?php echo $t['odate']; ?></td>
						<td>
                            <a href="<?php echo site_url('tb_item/edit/'.$t['id']); ?>" class="btn btn-info btn-sm"><span class="fa fa-pencil"></span> Edit</a> 
                            <a onclick="sweet();" href="<?php echo site_url('tb_item/remove/'.$t['id']); ?>" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span> Delete</a>
                            <!--<button class="btn btn-sm btn-danger" id="delete-btn" ><span class="fa fa-trash"></span> Delete</button>
                            < $deleted_uri =  base_url('tb_item/remove/'.$t['id']); ?>-->
 
                        </td>
                    </tr>
                    <?php } ?>
<!-- ************************************************************************ -->

                <!--<tfoot>
                <tr>
                <th>ID</th>
                  <th>Name</th>
                  <th>Detail</th>
                  <th>Date</th>
                  <th>Actions</th>
                </tr>
                </tfoot>-->
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        
    </div>
</div>

<script type="text/javascript">

function doit(type, fn, dl) {
    var elt = document.getElementById('example2');
    var wb = XLSX.utils.table_to_book(elt, {sheet:"Sheet JS"});
    return dl ?
        XLSX.write(wb, {bookType:type, bookSST:true, type: 'base64'}) :
        XLSX.writeFile(wb, fn || ('table_item.' + (type || 'xlsx')));
}


function tableau(pid, iid, fmt, ofile) {
    if(typeof Downloadify !== 'undefined') Downloadify.create(pid,{
            swf: 'downloadify.swf',
            downloadImage: 'download.png',
            width: 100,
            height: 30,
            filename: ofile, data: function() { return doit(fmt, ofile, true); },
            transparent: false,
            append: false,
            dataType: 'base64',
            onComplete: function(){ alert('Your File Has Been Saved!'); },
            onCancel: function(){ alert('You have cancelled the saving of this file.'); },
            onError: function(){ alert('You must put something in the File Contents or there will be nothing to save!'); }
    });
}
tableau('xlsxbtn',  'xportxlsx',  'xlsx',  'table_item.xlsx');

</script>

<script>
var $btnDLtoExcel = $('#DLtoExcel-2');
    $btnDLtoExcel.on('click', function () {
        $("#example2").excelexportjs({
            containerid: "tableData",
            datatype: 'table'
        });

    });




$(document).ready(function() {
  var table = $('#example2').DataTable({
    dom: 'Bfrtip',
    buttons: [
    {
      extend: 'excel',
      text: 'Export excel',
      className: 'exportExcel',
      filename: 'Export excel',
      exportOptions: {
        modifier: {
          page: 'all'
        }
      }
    }, 
    {
      extend: 'copy',
      text: '<u>C</u>opie presse papier',
      className: 'exportExcel',
      key: {
        key: 'c',
        altKey: true
      }
    }, 
    {
      text: 'Alert Js',
      className: 'exportExcel',
      action: function(e, dt, node, config) {
        alert('Activated!');
        // console.log(table);

        // new $.fn.dataTable.Buttons(table, {
        //   buttons: [{
        //     text: 'gfdsgfsd',
        //     action: function(e, dt, node, config) {
        //       alert('ok!');
        //     }
        //   }]
        // });
      }
    }]
  });

});
//***************************************************************** 
/*
$(document).ready(function() {
    $('#example2').DataTable({
        dom: "Bfrtip",
        buttons: [
            "copy",
          "excel",
          "csv",
          "pdf",
          "print",
/*
          {extent: "print", text: "<span class='glyphicon glyphicon-print'></span> Print"},          
          {extent: "excelHtml5", text: "<span class='glyphicon glyphicon-th-list'></span> Excel HTML5 Export"},
          {extent: "pdfHtml5", text: "<span class='glyphicon glyphicon-save'></span> PDF HTML5 Export", title: "Filename"}
          *//*],
          'paging': true,
        'lengthChange': true,
        'searching': true,
        'ordering': true,
        'info': true,
        'autoWidth': true,
        'exports' : true
    });
} );
</script>

<script>
            document.getElementById("delete-btn").addEventListener("click", function (event)
            {
                swal({
                    title: "Are you sure?",
                    text: "You will not be able to recover this imaginary file!",
                    icon: "warning",
                    buttons: {
                        cancel: {
                            visible: true,
                            text: "No, cancel plx!",
                            closeModal: false,
                        },
                        confirm: {
                            text: "Yes, delete it!",
                            className: "doit",
                            closeModal: false,
                        },
                    },
                })
                    //attach to the promise returned by swal()
                    .then((willDelete) => {
                        if (willDelete) {
                            swal("Deleted!", "Your imaginary file has been deleted.", "success")
                                    //another promise and another promise fulfilled response
                                    <?php echo site_url('tb_item/remove/'.$t['id']); ?>
                        } else {
                            swal("Cancelled", "Your imaginary file is safe :)", "error");
                        }
                    });
            });
        </script>