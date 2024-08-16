<div class="mt-auto mb-0 pb-2 mw-100">
    <div class="mt-5 d-flex align-items-center justify-content-center mw-100">
        <div class="collapse collapse-horizontal show mw-100" id="footerCollapse">
            <div class="">
                <div class="d-md-flex align-items-center text-center justify-content-center">
                    <div class="border-bottom border-2 wt064 fs-5 text-nowrap flex-md-grow-1 text-center p-0"><span
                            class="d-none d-sm-inline me-1">第五十二、五十三屆選手</span>陳祥譯 製</div>
                </div>
            </div>
        </div>
        <div data-bs-toggle="collapse" data-bs-target="#footerCollapse" aria-expanded="false"
            aria-controls="footerCollapse" id="coll" class="p-2">
            <div>
                <div id="collIcon">
                    <i class="bi bi-caret-left-fill"></i>
                </div>
            </div>
        </div>


        <div class="ms-4">
            <form action="{{route("api.set_theme")}}" method="post" id="themeform">
                @csrf
                <select id="theme" name="theme" class="form-select-sm border-2 border rounded-3 fw-bold">
                    <option value="light" @selected($theme == "light")>亮色</option>
                    <option value="dark" @selected($theme == "dark")>暗色</option>
                </select>
            </form>
        </div>
    </div>
</div>
<script>
    $(() => {
        $("#theme").change(() => {
            $("#themeform").submit();
        })
        const myCollapsible = document.getElementById('footerCollapse')
        myCollapsible.addEventListener('hide.bs.collapse', event => {
            $("#collIcon").animate({ deg: 180 }, {
                duration: 250,
                step: function (now) {
                    $("#collIcon").css({
                        transform: 'rotate(' + now + 'deg)'
                    });
                }
            });
        })
        myCollapsible.addEventListener('show.bs.collapse', event => {
            $("#collIcon").animate({ deg: 0 }, {
                duration: 250,
                step: function (now) {
                    $("#collIcon").css({
                        transform: 'rotate(' + now + 'deg)'
                    });
                }
            });
        })
    })
</script>