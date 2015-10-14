$(function() {
    Morris.Donut({
        element: 'graph-projects',
        data: projects,
        resize: true
    });
});