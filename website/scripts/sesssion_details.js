/**
 * Created by nix on 5/16/17.
 */

$(document).ready(
    function () {
        $(".session_info").hide();
        var $table = $(".packages");
        $table.css("max-width", $table.css("width"));

        $(".session_row").click(
            function () {
                var sessionid = $(this).data("sessionid");
                console.log(sessionid);
                $("#session-info-" + sessionid).toggle()
            }
        );

        $(".session_row").hover(
            function () {
                $(this).css( 'cursor', 'pointer' );
            }
        );
    }
);
