<template>
	<div>
		<div v-if="showComponent === 'RentalList'">
			<rental-list-component :base_url="base_url" @onShowComponent="setShowComponent"></rental-list-component>
		</div>

		<div v-if="showComponent === 'RentalInsert'">
			<rental-insert-component :base_url="base_url" @onShowComponent="setShowComponent"></rental-insert-component>
		</div>

			<div v-if="showComponent === 'RentalEdit'">
			<rental-edit-component :base_url="base_url" :rentalId="rentalId" @onShowComponent="setShowComponent"></rental-edit-component>
		</div>
	</div>
</template>

<script>

	import RentalList from "./RentalList.vue"
	import RentalInsert from "./RentalInsert.vue"
	import RentalEdit from "./RentalEdit.vue"

	export default {
		name: "rental-main-component",
		components: {
			"rental-list-component": RentalList,
			"rental-insert-component": RentalInsert,
			"rental-edit-component": RentalEdit
		},
		data() {
			return {
				showComponent		:'',
				rentalId            :''
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
				this.rentalId = id
				this.showComponent = component
			}
		},
		mounted() {
			this.setShowComponent('RentalList')
		}
	}
</script>
