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


                    <script>
                        (function() {
                            var cx = 'partner-pub-6089615049498543:4215273310';
                            var gcse = document.createElement('script');
                            gcse.type = 'text/javascript';
                            gcse.async = true;
                            gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
                                '//cse.google.com/cse.js?cx=' + cx;
                            var s = document.getElementsByTagName('script')[0];
                            s.parentNode.insertBefore(gcse, s);
                        })();
                    </script>
                    <gcse:searchresults-only><h2>Подождите, идет поиск</h2></gcse:searchresults-only>


                </div>
            </div>

            <!-- Bloc Right -->

            <?=isset($bloc_right)? $bloc_right : ''?>
        </div>

    </div>

</content>