<template>
	<div>
		<div v-if="showComponent === 'UserList'">
			<user-list-component :base_url="base_url" @onShowComponent="setShowComponent"></user-list-component>
		</div>

		<div v-if="showComponent === 'UserInsert'">
			<user-insert-component :base_url="base_url" @onShowComponent="setShowComponent"></user-insert-component>
		</div>

		<div v-if="showComponent === 'UserEdit'">
			<user-edit-component :base_url="base_url" :userId="userId" @onShowComponent="setShowComponent"></user-edit-component>
		</div>
	</div>
</template>

<script>

	import UserList from "./UserList.vue"
	import UserInsert from "./UserInsert.vue"
    import UserEdit from "./UserEdit.vue"
	export default {
		name: "user-main-component",
		components: {
			"user-list-component": UserList,
			"user-insert-component": UserInsert,
			"user-edit-component": UserEdit
		},
		data() {
			return {
				showComponent		:'',
				userId              :''
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
				this.userId = id
				this.showComponent = component
			}
		},
		mounted() {
			this.setShowComponent('UserList')
		}
	}
</script>
