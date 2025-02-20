function toggleDiv(fileNumber) {
    $('.fileActions').not('#fileActions' + fileNumber).removeClass('show');
    $('#fileActions' + fileNumber).toggleClass('show');
    updateArrowIndicators();
}

function updateArrowIndicators() {
    $('.toggleDiv').each(function() {
        var fileNumber = $(this).data('target').substr(-1);
        var isOpen = $('#fileActions' + fileNumber).hasClass('show');
        var arrowIndicator = $('#indicator' + fileNumber);
        
        arrowIndicator.find('.arrow-up').toggle(!isOpen);
        arrowIndicator.find('.arrow-down').toggle(isOpen);
    });
}

$(document).ready(function() {
    // Initialize arrow indicators
    updateArrowIndicators();

    $('.toggleDiv').click(function() {
        var target = $(this).data('target');
        toggleDiv(target.substr(target.length - 1));
        updateArrowIndicators(); // Update arrow indicators after toggle
    });
});

