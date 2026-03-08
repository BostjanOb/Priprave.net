<?php

use App\Models\Subject;

it('filters subjects by school type using pivot table scope', function () {
    $sql = Subject::forSchoolType(123)->toSql();

    expect($sql)->toContain('school_type_subject')
        ->and($sql)->not->toContain('subjects`.`school_type_id')
        ->and($sql)->not->toContain('"subjects"."school_type_id"');
});
