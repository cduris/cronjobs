<div class="panel col-lg-12">
	<div class="panel-heading">
		Cron tasks (new system) <span class="badge">2</span>
		<span class="panel-heading-action">
				<a id="desc-cronjobs-new" class="list-toolbar-btn" href="index->php?controller=AdminModules&amp;configure=cronjobs&amp;tab_module=administration&amp;module_name=cronjobs&amp;newcronjobs=1&amp;token=9ee43b459c34e6ed33a890ec78ef9ccd">
				<span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Add new task" data-html="true" data-placement="top">
				<i class="process-icon-new"></i>
				</span>
			</a>
			<a class="list-toolbar-btn" href="javascript:location->reload();">
				<span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Refresh list" data-html="true" data-placement="top">
				<i class="process-icon-refresh"></i>
				</span>
			</a>
		</span>
	</div>
	<div class="table-responsive-row clearfix table-stripped">
		<table class="table cronjobs">
			<thead>
				<tr class="nodrag nodrop">
					<th class="">
						<span class="title_box">ID</span>
					</th>
					<th class="">
						<span class="title_box">Url</span>
					</th>
					<th class="">
						<span class="title_box">Params</span>
					</th>
					<th class="">
						<span class="title_box">Hour</span>
					</th>
					<th class="">
						<span class="title_box">Minute</span>
					</th>
					<th class="">
						<span class="title_box">Day</span>
					</th>
					<th class="">
						<span class="title_box">Day of week</span>
					</th>
					<th class=" center">
						<span class="title_box">Active</span>
					</th>
					<th class=" center">
						<span class="title_box">Updated at</span>
					</th>
					<th class=" center">
						<span class="title_box">Created at</span>
					</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				{foreach from=$tasks item=task}
				<tr>
					<td>{$task->id}</td>
					<td>{$task->url}</td>
					<td>{$task->params}</td>
					<td>{$task->hour}</td>
					<td>{$task->minute}</td>
					<td>{$task->day_of_month}</td>
					<td>{$task->day_of_week}</td>
					<td>{$task->active}</td>
					<td>{$task->updated_at}</td>
					<td>{$task->created_at}</td>
				</tr>
				{/foreach}
			</tbody>
		</table>
	</div>
</div>