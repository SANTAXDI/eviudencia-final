<template>
	<div>
		<div v-if="showComponent === 'StatusList'">
			<status-list-component :base_url="base_url" @onShowComponent="setShowComponent"></status-list-component>
		</div>

		<div v-if="showComponent === 'StatusInsert'">
			<status-insert-component :base_url="base_url" @onShowComponent="setShowComponent"></status-insert-component>
		</div>

		<div v-if="showComponent === 'StatusEdit'">
			<status-edit-component :base_url="base_url" :statusId="statusId" @onShowComponent="setShowComponent"></status-edit-component>
		</div>
	</div>
</template>

<script>

	import StatusList from "./StatusList.vue"
	import StatusInsert from "./StatusInsert.vue"
	import StatusEdit from "./StatusEdit"

	export default {
		name: "status-main-component",
		components: {
			"status-list-component": StatusList,
			"status-insert-component": StatusInsert,
			"status-edit-component": StatusEdit
		},
		data() {
			return {
				showComponent		:'',
			};
		},
		props: {
			base_url: {
				type: String,
				default: ''
			}
		},
		methods: {
			setShowComponent: function(component,id) {
				this.statusId = id
				this.showComponent = component
			}
		},
		mounted() {
			this.setShowComponent('StatusList')
		}
	}
</script>
