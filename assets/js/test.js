let url = 'http://localhost:8888/app/posts/full_api.php'
const container = document.querySelector('.posts-container')
const commentSections = [...document.querySelectorAll('.comments-section')]

const getUser = (name) => {
	var value = "; " + document.cookie
	var parts = value.split("; " + name + "=")
	if (parts.length == 2) return parts.pop().split(";").shift()
}

const getData = url => {
	return fetch(url)
		.then((resp) => resp.json())
}
const initEventListeners = (elts, callback) => {
	elts.forEach(el => {
		el.addEventListener('click', callback)
	})
}

const createPost = (json) => {

	const commentsMarkup = json.pop().comments.map(comment => {
			
		return `
		<p data-id="${comment.post_id}">${comment.content}</p>
		`
	}).join('')
	
	const postsMarkup = json.map(post => {
		return `
		<img src="${post.image}"></img>
		<p>${commentsMarkup}</p>
		`

	}).join('')
	container.innerHTML = postsMarkup;
}

getData(url)
	.then(data => {
		if (window.location.pathname === '/profile.php') {
			let currentUser = getUser('user_id')
			const userfilter = data => data.posts.filter(user => user.user_id === currentUser)
		}
		createPost(data.posts)
	})