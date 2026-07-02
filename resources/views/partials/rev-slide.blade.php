@php
    $slideId = 901 + $index;
    $imageUrl = isset($slide->id) ? media_url($slide->image) : asset($slide->image);
    $subtitle = trim($slide->subtitle ?? '');
    $title = $slide->title ?? '';
    $description = strip_tags($slide->description ?? '');
@endphp
<li data-index="rs-{{ $slideId }}" data-transition="fade" data-slotamount="default" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="Power2.easeInOut" data-easeout="Power2.easeInOut" data-masterspeed="1000" data-thumb="{{ $imageUrl }}" data-rotate="0" data-fstransition="fade" data-fsmasterspeed="1000" data-fsslotamount="7" data-saveperformance="off" data-mad-title="{{ $title }}"@if($subtitle) data-mad-subtitle="{{ strtoupper($subtitle) }}"@endif data-mad-link="{{ $slide->button_link ?? route('projects.index') }}" data-title="" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
    <img src="{{ $imageUrl }}" alt="{{ $title }}" data-lazyload="{{ $imageUrl }}" data-bgposition="center center" data-bgfit="cover" data-bgparallax="4" class="rev-slidebg" data-no-retina>

    <div class="tp-caption tp-shape tp-shapewrapper"
        id="rrzb_{{ $slideId }}-1"
        data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
        data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']"
        data-width="full" data-height="full" data-whitespace="nowrap"
        data-type="shape" data-basealign="slide" data-responsive_offset="off" data-responsive="off"
        data-frames='[{"from":"opacity:0;","speed":1000,"to":"o:1;","delay":0,"ease":"Power4.easeOut"},{"delay":"wait","speed":1000,"to":"opacity:0;","ease":"Power4.easeOut"}]'
        data-textAlign="['left','left','left','left']"
        data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
        style="z-index: 4;background-color:rgba(0, 0, 0, 0.2);border-color:rgba(0, 0, 0, 0);border-width:0px;">
    </div>

    <div id="rrzb_{{ $slideId }}" class="rev_row_zone rev_row_zone_middle" style="z-index: 7;">
        <div class="tp-caption"
            id="slide-{{ $slideId }}-layer-1"
            data-x="['left','left','left','left']" data-hoffset="['100','100','100','100']"
            data-y="['bottom','bottom','bottom','bottom']" data-voffset="['0','0','0','0']"
            data-width="none" data-height="none" data-whitespace="nowrap"
            data-type="row" data-columnbreak="3" data-responsive_offset="on" data-responsive="off"
            data-frames='[{"delay":10,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
            data-margintop="[0,0,0,0]" data-marginright="[0,0,0,0]" data-marginbottom="[50,60,40,50]" data-marginleft="[0,0,0,0]"
            data-textAlign="['inherit','inherit','inherit','inherit']"
            data-paddingtop="[0,0,0,0]" data-paddingright="[150,130,80,50]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[150,130,80,50]"
            style="z-index: 7; white-space: nowrap; font-size: 20px; line-height: 22px; font-weight: 400; color: #ffffff; letter-spacing: 0px;">

            <div class="tp-caption"
                id="slide-{{ $slideId }}-layer-2"
                data-x="['left','left','left','left']" data-hoffset="['0','0','100','100']"
                data-y="['top','top','top','top']" data-voffset="['0','0','100','100']"
                data-width="none" data-height="none" data-whitespace="nowrap"
                data-type="column" data-responsive_offset="on" data-responsive="off"
                data-frames='[{"delay":"+0","speed":750,"sfxcolor":"#fff","sfx_effect":"","frame":"0","from":"z:0;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power4.easeInOut"}]'
                data-columnwidth="100%" data-verticalalign="top"
                data-margintop="[0,0,0,0]" data-marginright="[0,0,0,0]" data-marginbottom="[0,0,0,0]" data-marginleft="[0,0,0,0]"
                data-textAlign="['center','center','center','center']"
                data-paddingtop="[50,50,50,50]" data-paddingright="[0,0,30,30]" data-paddingbottom="[50,50,50,50]" data-paddingleft="[0,0,30,30]"
                style="z-index: 8; width: 100%;">

                @if($subtitle)
                <div class="tp-caption tp-resizeme slider-caption-text"
                    id="slide-{{ $slideId }}-layer-3"
                    data-x="['left','center','center','center']" data-hoffset="['0','0','0','0']"
                    data-y="['top','bottom','bottom','bottom']" data-voffset="['0','260','250','190']"
                    data-width="['none','none','none','none']" data-height="none" data-whitespace="['nowrap','nowrap','nowrap','nowrap']"
                    data-type="text" data-basealign="slide" data-responsive_offset="off"
                    data-frames='[{"delay":"+490","speed":750,"sfxcolor":"#fff","sfx_effect":"blockfromleft","frame":"0","from":"z:0;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                    data-margintop="[0,0,0,0]" data-marginright="[0,0,0,0]" data-marginbottom="[0,0,0,0]" data-marginleft="[0,0,0,0]"
                    data-textAlign="['center','inherit','inherit','inherit']"
                    data-paddingtop="[5,5,5,5]" data-paddingright="[5,5,5,5]" data-paddingbottom="[5,5,5,5]" data-paddingleft="[5,5,5,5]"
                    style="z-index: 10; white-space: normal; font-size: 18px; line-height: 15px; font-weight: 700; color: #fff; letter-spacing: 3px; display: inline-block;">
                    {{ strtoupper($subtitle) }}
                </div>
                @endif

                <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme"
                    id="slide-{{ $slideId }}-layer-4"
                    data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']"
                    data-y="['top','top','top','top']" data-voffset="['0','0','0','0']"
                    data-width="full" data-height="15" data-whitespace="normal"
                    data-type="shape" data-responsive_offset="on"
                    data-frames='[{"delay":"+0","speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                    data-margintop="[0,0,0,0]" data-marginright="[0,0,0,0]" data-marginbottom="[0,0,0,0]" data-marginleft="[0,0,0,0]"
                    data-textAlign="['inherit','inherit','inherit','inherit']"
                    data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                    style="z-index: 13; display: block;background-color:rgba(0, 0, 0, 0);">
                </div>

                @if($title)
                <div class="tp-caption tp-resizeme tp-linkmod slider-caption-text"
                    id="slide-{{ $slideId }}-layer-5"
                    data-x="['left','center','center','center']" data-hoffset="['0','0','0','0']"
                    data-y="['top','bottom','bottom','bottom']" data-voffset="['0','170','140','120']"
                    data-fontsize="['60','60','60','40']" data-lineheight="['60','60','60','40']"
                    data-width="['none','none','100%','100%']" data-height="none" data-whitespace="['nowrap','normal','normal','normal']"
                    data-type="text" data-actions='' data-basealign="slide" data-responsive_offset="off"
                    data-frames='[{"delay":"+590","speed":750,"sfxcolor":"#fff","sfx_effect":"blockfromleft","frame":"0","from":"z:0;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"},{"frame":"hover","speed":"0","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgb(255,255,255);"}]'
                    data-margintop="[0,0,0,0]" data-marginright="[0,0,0,0]" data-marginbottom="[0,0,0,0]" data-marginleft="[0,0,0,0]"
                    data-textAlign="['center','center','center','center']"
                    data-paddingtop="[0,0,0,0]" data-paddingright="[5,5,5,5]" data-paddingbottom="[10,10,10,10]" data-paddingleft="[5,5,5,5]"
                    style="z-index: 11; white-space: normal; font-weight: 600; color: #fff; letter-spacing: 2px; display: inline-block; text-decoration: none; text-transform:capitalize">
                    {{ $title }}
                </div>
                @endif

                <div class="tp-caption tp-shape tp-shapewrapper tp-resizeme"
                    id="slide-{{ $slideId }}-layer-6"
                    data-x="['left','left','left','left']" data-hoffset="['0','0','0','0']"
                    data-y="['top','top','top','top']" data-voffset="['0','0','0','0']"
                    data-width="full" data-height="15" data-whitespace="normal"
                    data-type="shape" data-responsive_offset="on"
                    data-frames='[{"delay":"+0","speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                    data-margintop="[0,0,0,0]" data-marginright="[0,0,0,0]" data-marginbottom="[0,0,0,0]" data-marginleft="[0,0,0,0]"
                    data-textAlign="['inherit','inherit','inherit','inherit']"
                    data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                    style="z-index: 9; display: block;background-color:rgba(0, 0, 0, 0);">
                </div>

                @if($description)
                <div class="tp-caption tp-resizeme slider-caption-text slider-caption-text--wrap"
                    id="slide-{{ $slideId }}-layer-7"
                    data-x="['left','center','center','center']" data-hoffset="['0','0','0','0']"
                    data-y="['top','bottom','bottom','bottom']" data-voffset="['0','100','80','70']"
                    data-width="['none','none','100%','100%']" data-height="none" data-whitespace="['normal','normal','normal','normal']"
                    data-type="text" data-basealign="slide" data-responsive_offset="off"
                    data-frames='[{"delay":"+690","speed":750,"sfxcolor":"#fff","sfx_effect":"blockfromleft","frame":"0","from":"z:0;","to":"o:1;","ease":"Power4.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                    data-margintop="[0,0,0,0]" data-marginright="[0,0,0,0]" data-marginbottom="[0,0,0,0]" data-marginleft="[0,0,0,0]"
                    data-textAlign="['center','center','center','center']"
                    data-paddingtop="[5,5,5,5]" data-paddingright="[5,5,5,5]" data-paddingbottom="[5,5,5,5]" data-paddingleft="[5,5,5,5]"
                    style="z-index: 12; white-space: normal; font-size: 16px; line-height: 22px; font-weight: 400; color: #fff; letter-spacing: 0px; display: inline-block;">
                    {{ $description }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <div class="tp-caption tp-shape tp-shapewrapper"
        id="slide-{{ $slideId }}-layer-8"
        data-x="['center','center','center','center']" data-hoffset="['0','0','0','0']"
        data-y="['middle','middle','middle','middle']" data-voffset="['0','0','0','0']"
        data-width="full" data-height="full" data-whitespace="nowrap"
        data-visibility="['on','on','off','off']"
        data-type="shape" data-basealign="slide" data-responsive_offset="off" data-responsive="off"
        data-frames='[{"delay":50,"speed":100,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":1000,"frame":"999","to":"opacity:0;","ease":"Power3.easeIn"}]'
        data-textAlign="['inherit','inherit','inherit','inherit']"
        data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
        style="z-index: 5;background-color:rgba(0, 0, 0, 0);border-color:rgb(255,255,255);border-style:solid;border-width:0px;">
    </div>
</li>
