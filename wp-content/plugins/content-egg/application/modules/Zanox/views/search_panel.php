<?php defined('\ABSPATH') || exit; ?>
<input type="text" class="input-sm col-md-4" ng-model="query_params.<?php echo $module_id; ?>.minprice" ng-init="query_params.<?php echo $module_id; ?>.minprice = ''" placeholder="<?php _e('Min. price', 'content-egg'); ?>" />
<input type="text" class="input-sm col-md-4" ng-model="query_params.<?php echo $module_id; ?>.maxprice" ng-init="query_params.<?php echo $module_id; ?>.maxprice = ''" placeholder="<?php _e('Max. price', 'content-egg'); ?>" />