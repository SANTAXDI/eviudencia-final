<template>
	<section>
		<div>
			LISTADO DE CATEGORÍAS
		</div>
		<div>
			<article>
			
					<div>
						<label>Nombres</label>
						<input type="text" name="name" v-model="name" @keyup.enter="search">
					</div>
					<div>
						<button @click="search">Buscar</button>						
						<button  @click="showComponent('CategoryInsert')">Crear</button>
					</div>
							
			</article>

			<article>
				<table>					
					<thead>
						<tr>
							<th>Nombre</th>
							<th>Estado</th>
							<th>Acciones</th>
						</tr>
					</thead>
					<tbody>						
						<tr v-for="category in categoryList">
							<td>{{ category.name }}</td>
							<td>{{ category.status_id }}</td>
							<td>
								<button @click="showComponent('CategoryEdit', category.id)"> Editar</button>	
								<button @click="deleteCategory(category.id)"> Eliminar</button>
							</td>
						</tr>
					</tbody>
				</table>	
			</article>
		</div>			
	</section>
</template>

<script>
	export default {
		name: "category-list-component",
		data() {
			return {
				name			:'',
				categoryList 	:[],
			};
		},
		props: {
			base_url: {
				type: String,
				default: ''
			}
		},
		methods: {
			showComponent: function(component,id) {
				this.$emit('onShowComponent', component,id)
			},

			search: function() {
				let that = this

				let headers = {
					headers: {
						"Conten-Type":  "application/json"
					}
				}

				let url = this.base_url + '/api/categories?name=' + this.name

				axios
					.get(url, headers)
					.then((response) => {
						if(response.data.type === 'success') {
							that.categoryList = response.data.data
						} else {
							alert(response.data.message)
						}

					})
					.catch((error) => {
						console.log(error)
					})
			},
				deleteCategory: function (id) {
				let that = this

				let headers = {
					headers: {
						"Conten-Type":  "application/json"
					}
				}

				let url = this.base_url + '/api/categories/' + id

				axios
					.delete(url, headers)
					.then((response) => {
						
						if(response.data.type === 'success') {							
							alert(response.data.message)
							that.search()
						} else {
							alert(response.data.message)
						}

					})
					.catch((error) => {						
						alert(error.data.message)
					})
			}

		}
	}
</script>
