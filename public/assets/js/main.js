if (times) {
    times.addEventListener('click', e => {
        if (e.target.className === 'btn-simple btn btn-xs btn-danger') {
            if (confirm('Are you sure?')) {
                const id = e.target.getAttribute('data-id');

                fetch(`/time-log/delete/${id}`, {
                    method: 'DELETE'
                }).then(res => window.location.reload());
            }
        }
    });
}


