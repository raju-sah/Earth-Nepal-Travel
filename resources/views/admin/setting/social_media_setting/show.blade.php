<div class="row align-items-center">
    <div class="row border-top border-bottom py-3">

    <div class="col-md-4">
            <div class="card-content">
                <b class="d-block text-uppercase text-14">
                    social icon
                </b>
                <x-table.table_image name="{{ $social_media_setting->social_icon }}"
                    url="{{ $social_media_setting->icon_path }}" />
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-content">
                <b class="d-block text-uppercase text-14">
                    name
                </b>
                <span>{{ $social_media_setting->name }}</span>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-content">
                <b class="d-block text-uppercase text-14">
                    slug
                </b>
                <span>{{ $social_media_setting->slug }}</span>
            </div>
        </div>
       
    </div>

    <div class="card-content mt-2"><b class="d-block text-uppercase text-14">social
            link</b><span>{{ $social_media_setting->social_link }}</span>
    </div>
   

</div>

