<ul class="footer-social">
    @if($setting->facebook !== null)
        <li><a href="{{ $setting->facebook }}" target="_blank" class="facebook"><i class="fa fa-facebook"></i></a></li>
    @endif
    @if($setting->twitter !== null)
        <li><a href="{{ $setting->twitter }}" target="_blank" class="twitter"><i class="fa fa-twitter"></i></a></li>
    @endif
    @if($setting->youtube !== null) <!-- Assuming you want to keep YouTube -->
        <li><a href="{{ $setting->youtube }}" target="_blank" class="youtube"><i class="fa fa-youtube"></i></a></li>
    @endif
    @if($setting->linkedin !== null)
        <li><a href="{{ $setting->linkedin }}" target="_blank" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
    @endif
    @if($setting->instagram !== null) <!-- Instagram link addition -->
        <li><a href="{{ $setting->instagram }}" target="_blank" class="instagram"><i class="fa fa-instagram"></i></a></li>
    @endif
</ul>