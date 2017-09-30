<div class="row status-container">
    <div class="span5">
        <p class="status-text">You have provided information for <font color="#000">0 of 45</font> fields.</p>
    </div>
    <div class="span4 action-bar">
        <ul class="action-list">
            <li><?php echo CHtml::submitButton('Submit', array('class'=>'action-btn', 'id'=>'action-btn-1')); ?></li>
            <li><?php echo CHtml::resetButton('Discard', array('class'=>'action-btn', 'id'=>'action-btn-2')); ?></li>
            <li><input type="button" class="action-btn" id="action-btn-3" value="Next"></li>
        </ul>
    </div>
</div>