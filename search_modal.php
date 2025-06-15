<!-- search_modal.php -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form action="producestore.php" method="get">
        <div class="modal-header">
          <h5 class="modal-title" id="searchModalLabel">商品搜尋</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="關閉"></button>
        </div>
        <div class="modal-body">
          <div class="input-group">
            <input type="text" name="search_name" class="form-control" placeholder="請輸入關鍵字..." required>
            <input type="hidden" name="from_nav" value="1">
            <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> 搜尋</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
