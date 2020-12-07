<template>
	<section>
		<div>
			EDITAR CATEGORÍA
		</div>
		<section>
			<div>
				<label>Nombre</label>
				<input type="text" v-model="category.name">
			</div>
			<div>
				<button @click="edit">Editar</button>
				<button @click="close">Cancelar</button>
			</div>
		</section>			
	</section>
</template>

<script>
	export default {
		name: "category-edit-component",
		data() {
			return {				
				category 		:{
					name: 	'',					
				}
			};
		},
		props: {
			base_url: {
				type: String,
				default: ''
			},
			categoryId: {
				type: Number,
				default: 0
			},
		},
		methods: {
			close: function () {
				this.$emit('onShowComponent', 'CategoryList')
			},	
			getCategoryById: function () {
				let that = this

				let headers = {
					headers: {
						"Conten-Type":  "application/json"
					}
				}

				let url = this.base_url + '/api/categories/' + this.categoryId

				axios
					.get(url, headers)
					.then((response) => {
						
						if(response.data.type === 'success') {							
							that.category = response.data.data.category
						} else {
							alert(response.data.message)
						}

					})
					.catch((error) => {						
						alert(error.data.message)
					})
			},
			edit: function () {
				let that = this

				let headers = {
					headers: {
						"Conten-Type":  "application/json"
					}
				}

				let url = this.base_url + '/api/categories/' + this.categoryId

				let data = {
					name	: this.category.name
				}

				axios
					.put(url, data, headers)
					.then((response) => {
						
						if(response.data.type === 'success') {
							alert(response.data.message)
							that.close()
						} else {
							alert(response.data.message)
						}

					})
					.catch((error) => {						
						alert(error.data.message)
					})
			}
		},
		mounted() {
			this.getCategoryById()
		}
	}
</script>
