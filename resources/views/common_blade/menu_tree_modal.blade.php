<div class="modal fade" id="tree" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-uppercase" id="modalCenterTitle">Menu in Tree View</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @foreach ($menus as $menu)
                    @include('common_blade.menu-item-index', ['menuItem' => $menu, 'level' => 0])
                @endforeach
            </div>
        </div>
    </div>
</div>
