<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Created by PhpStorm.
 * User: Vitalik
 * Date: 11.08.2015
 * Time: 16:55
 */
?>
<content>
    <div id="content">

        <div class="row">
            <!-- Context -->
            <div class="col-md-8">
                <div id="context">


                    <div id="cse-search-results"></div>
                    <script type="text/javascript">
                        var googleSearchIframeName = "cse-search-results";
                        var googleSearchFormName = "cse-search-box";
                        var googleSearchFrameWidth = 750;
                        var googleSearchDomain = "www.google.com";
                        var googleSearchPath = "/cse";
                    </script>
                    <script type="text/javascript" src="http://www.google.com/afsonline/show_afs_search.js"></script>

                </div>
            </div>

            <!-- Bloc Right -->
            <?=isset($bloc_right)? $bloc_right : ''?>
        </div>

    </div>

</content>