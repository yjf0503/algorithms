<?php

class TreeNode{
    public $data = null;
    public $children = [];

    public function __construct(string $data) {
        $this->data = $data;
    }

    public function add(TreeNode $node){
        $this->children[] = $node;
    }
}


class Tree{
    public $root = null;
    public $result = [];
    public function __construct(TreeNode $root) {
        $this->root = $root;
    }

    public function traverse(TreeNode $node, $level=0){
        if($node){
            echo str_repeat('-',$level) . $node->data . '<br/>';

            foreach ($node->children as $child){
                $this->traverse($child,$level+1);
            }
        }
    }

    public function bfs(TreeNode $root){
        $result = array();
        $result[] = $root->data;
        $children = $root->children;
        $temp = [];

        while(!empty($children)){
            foreach ($children as $childNode) {
                $result[] = $childNode->data;
                if(!empty($childNode)){
                    foreach ($childNode->children as $child){
                        $temp[] = $child;
                    }
                }
            }
            $children = $temp;
            $temp = [];
        }
        print_r($result);
        echo '<br/>';
    }

    public function dfs(TreeNode $root){
        $result = array();
        $stack = new SplStack();
        $stack->push($root);

        while($stack->count() > 0){
            $current = $stack->pop();
            $result[] = $current->data;
            $current->children = array_reverse($current->children);
            foreach ($current->children as $childNode) {
                $stack->push($childNode);
            }
        }
        print_r($result);
        echo '<br/>';
    }

    public function dfsRecursive(TreeNode $node){
        $this->result[] = $node->data;

        if(!empty($node->children)){
            $node->children = array_reverse($node->children);
            foreach ($node->children as $child){
                $this->dfsRecursive($child);
            }
        }
        return true;
    }
}

$root = new TreeNode(0);
$child1 = new TreeNode(1);
$root->add($child1);

$child2 = new TreeNode(2);
$child3 = new TreeNode(3);
$child1->add($child2);
$child1->add($child3);

$child4 = new TreeNode(4);
$child2->add($child4);

$tree = new Tree($root);
$tree->traverse($root);
$tree->bfs($root);
$tree->dfs($root);
$tree->dfsRecursive($root);
print_r($tree->result);