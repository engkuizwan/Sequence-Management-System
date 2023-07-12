    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        {{$card??"" == 1? "<div class='card' id='maincard'>":""}}
        
          {{-- <div class="card-header">
            <h3 class="card-title"></h3>
  
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div> --}}
          <div  style="min-height: 70%">
              @yield('content')
          </div>
          <!-- /.card-body -->
          {{-- <div class="card-footer">
            Footer
          </div> --}}
          <!-- /.card-footer-->
        {{$card??"" == 1?"</div>":""}}
        
        <!-- /.card -->
  
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->