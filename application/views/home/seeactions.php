<div class="seeactions">
	<h2 class="seeactions-title">See Auctions</h2>
	<p class="seeactions-subdescription">A platform to exchange the coins with peers at the desired rate</p>

	<table class="table table-striped table-bordered table-list" id="seeaction_list_table">
		<thead>
			<th>#</th>
			<th>Name</th>
			<!-- <th>Count</th> -->
			<!-- <th>Auctions</th> -->
			<th>Counter</th>
			<th>User Name</th>
		</thead>
		<tbody>
			<?php $i = 1;?>
			<?php foreach ($action_list as $action_item): ?>
			<tr>
				<td><?php echo $i; $i++;?></td>
				<td><?=$action_item['coin_name']?></td>
				
				<td style="display: flex;flex-direction: column; align-items: center;">
					<button class="btn btn-default action-up-btn" data-action-id="<?=$action_item['action_id']?>"><i class="fas fa-chevron-up"></i></button>
					<span class="action-counter-<?=$action_item['action_id']?>"><?=$action_item['action_counter']?></span>
					<button class="btn btn-default action-down-btn" data-action-id="<?=$action_item['action_id']?>"><i class="fas fa-chevron-down"></i></button>
				</td>
				<!-- <td class="action-counter-<?=$action_item['action_id']?>"><?=$action_item['action_counter']?></td> -->
				<td><?=$action_item['name']?></td>
			</tr>
			<?php endforeach ?>

		</tbody>
	</table>
</div>

<script type="text/javascript" src="<?=base_url()?>assets/js/home/seeactions.js"></script>