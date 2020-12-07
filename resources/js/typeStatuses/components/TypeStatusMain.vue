<template>
	<div>
		<div v-if="showComponent === 'TypeStatusList'">
			<typeStatus-list-component :base_url="base_url" @onShowComponent="setShowComponent"></typeStatus-list-component>
		</div>

		<div v-if="showComponent === 'TypeStatusInsert'">
			<typeStatus-insert-component :base_url="base_url" @onShowComponent="setShowComponent"></typeStatus-insert-component>
		</div>

		<div v-if="showComponent === 'TypeStatusEdit'">
			<typeStatus-edit-component :base_url="base_url" :typeStatusId="typeStatusId" @onShowComponent="setShowComponent"></typeStatus-edit-component>
		</div>
	</div>
</template>

<script>

	import TypeStatusList from "./TypeStatusList.vue"
	import TypeStatusInsert from "./TypeStatusInsert.vue"
	import TypeStatusEdit from "./TypeStatusEdit"

	export default {
		name: "typeStatus-main-component",
		components: {
			"typeStatus-list-component": TypeStatusList,
			"typeStatus-insert-component": TypeStatusInsert,
			"typeStatus-edit-component": TypeStatusEdit
		},
		data() {
			return {
				showComponent		:'',
				typeStatusId        :''
				
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
				this.typeStatusId = id
				this.showComponent = component
			}
		},
		mounted() {
			this.setShowComponent('TypeStatusList')
		}
	}
</script>
