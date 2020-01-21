<template>
    <button 
        class="focus:outline-none" 
        data-balloon="⇧ SHIFT + Click" data-balloon-pos="up"
        @click.shift="deleteSubject"
    >
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-6 icon-trash">
            <path class="primary" d="M5 5h14l-.89 15.12a2 2 0 0 1-2 1.88H7.9a2 2 0 0 1-2-1.88L5 5zm5 5a1 1 0 0 0-1 1v6a1 1 0 0 0 2 0v-6a1 1 0 0 0-1-1zm4 0a1 1 0 0 0-1 1v6a1 1 0 0 0 2 0v-6a1 1 0 0 0-1-1z"></path>
            <path class="secondary" d="M8.59 4l1.7-1.7A1 1 0 0 1 11 2h2a1 1 0 0 1 .7.3L15.42 4H19a1 1 0 0 1 0 2H5a1 1 0 1 1 0-2h3.59z"></path>
        </svg>
    </button>
</template>


<script>
export default {
    props: {
        route: String
    },
    methods: {
        deleteSubject: function() {
            let del = document.createElement('FORM');
            del.method = 'POST';
            del.action = this.route;
            del.style.display = 'none';

            let method = document.createElement('INPUT');
            method.name = '_method';
            method.value = 'DELETE';

            let csrf = document.createElement('INPUT');
            csrf.name = '_token';
            csrf.value = document.head.querySelector('meta[name="csrf-token"]').content;

            del.appendChild(csrf);
            del.appendChild(method);
            document.body.appendChild(del);
            del.submit();
        }
    }
};
</script>