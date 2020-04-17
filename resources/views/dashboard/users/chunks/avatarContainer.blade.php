<div class="avatar-container" style="margin-right:30px !important;">
    <img id="avatarPrev" src="{{ !isset($avatar) || $avatar === 'user.png' ? asset('upload/avatars/user.png') : asset("upload/$avatar") }}" class="AvatarImage mb-2"
         style="max-width: 200px;
									width: 150px;
									height: 150px;
									max-height: 200px;
                                    margin-left:0 !important;
									margin-right:0px !important;"/>

    <label for="avatar" class="btn btn-default btn-block"
           style="border: 1px solid #ccc;font-size: 0.7875rem !important;">
        Wybierz plik <i style="margin-left: 5px;" class="fas fa-camera"></i>
    </label>
    <input type="file" accept="image/jpeg,image/png"
           placeholder="avatar" name="avatar" id="avatar" style="display:none;">
</div>