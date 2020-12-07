<template>
	<section>
		<div>
			NUEVA TIPO DE ESTATUS
		</div>
		<section>
			<div>
				<label>Nombre</label>
				<input type="text" v-model="name">
			</div>
			<div>
				<button @click="insert">Guardar</button>
				<button @click="close">Cancelar</button>
			</div>
		</section>			
	</section>
</template>

<script>
	export default {
		name: "typeStatus-insert-component",
		data() {
			return {
				name			:'',			
			};
		},
		props: {
			base_url: {
				type: String,
				default: ''
			}
		},
		methods: {
			close: function () {
				this.$emit('onShowComponent', 'TypeStatusList')
			},		
			insert: function () {
				let that = this

				let headers = {
					headers: {
						"Conten-Type":  "application/json"
					}
				}

				let url = this.base_url + '/api/typeStatuses'

				let data = {
					name	:this.name
				}

				axios
					.post(url, data, headers)
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
		}
	}
</script>
