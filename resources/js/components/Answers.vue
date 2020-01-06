<template>
	<div>
		<div class="row mt-4" v-cloak v-if="count">
			<div class="col-md-12">
				<div class="card">
					<div class="card-body">
						<div class="card-title">
							<h2>{{ title }}</h2>
						</div>
						<hr />
						<answer
							@deleted="remove(index)"
							v-for="(answer, index) in answers"
							:answer="answer"
							:key="answer.id"
						></answer>
						<div class="text-center mt-3" v-if="nextUrl">
							<button @click.prevent="fetch(nextUrl)" class="btn btn-outline-secondary">Load More Answers</button>
						</div>
					</div>
				</div>
			</div>
		</div>
		<new-answer @created="addition" :question-id="question.id"></new-answer>
	</div>
</template>
<script>
import Answer from './Answer.vue'
import NewAnswer from './NewAnswer'
import highlight from '../mixins/highlight.js'

export default {
	props: ['question'],
	mixins: [highlight],
	data() {
		return {
			questionId: this.question.id,
			count: this.question.answers_count,
			answers: [],
			nextUrl: null
		}
	},
	created() {
		this.fetch(`/questions/${this.questionId}/answers`)
	},
	methods: {
		addition(answer) {
			this.answers.push(answer)
			this.count++
			this.highlight()
		},
		remove(index) {
			this.answers.splice(index, 1)
			this.count--
		},
		fetch(endpoint) {
			if (!this.signedIn) {
				axios.get(endpoint).then(({ data }) => {
					this.nextUrl = null
				})
				this.$toast.warning(
					`Please login to view all the answers 🇪️🇷️`,
					'Warning',
					{
						timeout: 3000,
						position: 'center'
					}
				)
			}
			axios.get(endpoint).then(({ data }) => {
				this.answers.push(...data.data)
				this.nextUrl = data.next_page_url
			})
		}
	},
	computed: {
		title() {
			return this.count + ' ' + (this.count > 1 ? 'Answers' : 'Answer')
		}
	},
	components: { Answer, NewAnswer }
}
</script>