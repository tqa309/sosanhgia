<?php defined('\ABSPATH') || exit; ?>
<input type="text" class="input-sm col-md-4" ng-model="query_params.<?php echo $module_id; ?>.price_min" ng-init="query_params.<?php echo $module_id; ?>.price_max = ''" placeholder="<?php _e('Min. price', 'content-egg'); ?>" />
<input type="text" class="input-sm col-md-4" ng-model="query_params.<?php echo $module_id; ?>.price_max" ng-init="query_params.<?php echo $module_id; ?>.price_max = ''" placeholder="<?php _e('Max. price', 'content-egg'); ?>" />