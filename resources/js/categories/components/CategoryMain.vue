<template>
	<div>
		<div v-if="showComponent === 'CategoryList'">
			<category-list-component :base_url="base_url" @onShowComponent="setShowComponent"></category-list-component>
		</div>

		<div v-if="showComponent === 'CategoryInsert'">
			<category-insert-component :base_url="base_url" @onShowComponent="setShowComponent"></category-insert-component>
		</div>

		<div v-if="showComponent === 'CategoryEdit'">
			<category-edit-component :base_url="base_url" :categoryId="categoryId" @onShowComponent="setShowComponent"></category-edit-component>
		</div>
	</div>
</template>

<script>

	import CategoryList from "./CategoryList.vue"
	import CategoryInsert from "./CategoryInsert.vue"
	import CategoryEdit from "./CategoryEdit.vue"

	export default {
		name: "category-main-component",
		components: {
			"category-list-component": CategoryList,
			"category-insert-component": CategoryInsert,
			"category-edit-component": CategoryEdit
		},
		data() {
			return {
				showComponent		:'',
				categoryId 			:'',
			};
		},
		props: {
			base_url: {
				type: String,
				default: ''
			}
		},
		methods: {
			setShowComponent: function(component, id) {				
				this.categoryId = id
				this.showComponent = component
			}
		},
		mounted() {
			this.setShowComponent('CategoryList')
		}
	}
</script>
