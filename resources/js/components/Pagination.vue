<template>
	<div class="row align-items-center">
		<div class="col">
			<button :disabled="isFirst" @click="prev" class="btn btn-outline-secondary">Newer</button>
		</div>
		<div class="col text-center">{{ pagesInfo }}</div>
		<div class="col text-right">
			<button :disabled="isLast" @click="next" class="btn btn-outline-secondary">Older</button>
		</div>
	</div>
</template>

<script>
export default {
	props: ['meta', 'links'],
	computed: {
		pagesInfo() {
			return `Page ${this.meta.current_page} of ${this.meta.last_page}`
		},
		isFirst() {
			return this.meta.current_page === 1
		},
		isLast() {
			return this.meta.current_page === this.meta.last_page
		}
	},
	methods: {
		switchPage() {
			this.$router.push({
				name: 'questions',
				query: {
					page: this.meta.current_page
				}
			})
		},
		prev() {
			if (!this.isFirst) {
				this.meta.current_page--
			}
			this.switchPage()
		},
		next() {
			if (!this.last_page) {
				this.meta.current_page++
			}
			this.switchPage()
		}
	}
}
</script>