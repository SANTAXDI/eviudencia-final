<template>
	<div>
		<div v-if="showComponent === 'RoleList'">
			<role-list-component :base_url="base_url" @onShowComponent="setShowComponent"></role-list-component>
		</div>

		<div v-if="showComponent === 'RoleInsert'">
			<role-insert-component :base_url="base_url" @onShowComponent="setShowComponent"></role-insert-component>
		</div>

			<div v-if="showComponent === 'RoleEdit'">
			<role-edit-component :base_url="base_url" :roleId="roleId" @onShowComponent="setShowComponent"></role-edit-component>
		</div>
	</div>
</template>

<script>

	import RoleList from "./RoleList.vue"
	import RoleInsert from "./RoleInsert.vue"
	import RoleEdit from "./RoleEdit.vue"

	export default {
		name: "role-main-component",
		components: {
			"role-list-component": RoleList,
			"role-insert-component": RoleInsert,
			"role-edit-component": RoleEdit
		},
		data() {
			return {
				showComponent		:'',
				roleId              :''
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
				this.roleId = id
				this.showComponent = component
			}
		},
		mounted() {
			this.setShowComponent('RoleList')
		}
	}
</script>
