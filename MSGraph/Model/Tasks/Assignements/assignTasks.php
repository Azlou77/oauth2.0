<?php
// Request to get tasks assignements
$request = $graph->createRequest("GET", "/planner/tasks/W8jRGK8DEkGhRci5WuBt_ZgAKsHE/assignments")
    ->setReturnType(Model\PlannerAssignments::class)
    ->execute();
$plannerassignments = $request->getBody();
?>