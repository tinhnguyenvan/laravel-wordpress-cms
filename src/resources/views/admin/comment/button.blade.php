<div class="row">
    <div class="select_action float-left" style="display: none; margin: 0 5px 0 15px">
        <button class="btn btn-danger" name="button_type" type="submit" value="0">
            <i class="fa fa-trash"></i>
            {{ trans('common.trash') }}
        </button>
    </div>

    <div class="select_action float-left" style="display: none; margin-right: 5px">
        <button class="btn btn-primary" name="button_type" type="submit" value="{{ \App\Models\Comment::STATUS_APPROVED }}">
            <i class="fa fa-check-square-o"></i>
            Approved
        </button>
    </div>

    <div class="select_action float-left" style="display: none; margin-right: 5px">
        <button class="btn btn-warning" name="button_type" type="submit" value="{{ \App\Models\Comment::STATUS_REJECT }}">
            <i class="fa fa-ban"></i>
            Reject
        </button>
    </div>
</div>