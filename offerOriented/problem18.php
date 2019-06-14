<?php

/**
 * Desc: 树的子结构
 * User: jiefuyang
 * Date: 2019-06-14
 * Time: 10:51
 */

class TreeNode {
    public $data = null;
    public $children = [];
    public $left = null;
    public $right = null;

    public function __construct(string $data) {
        $this->data = $data;
    }

    public function add(TreeNode $node) {
        $this->children[] = $node;
    }

    public function setLeft(TreeNode $child) {
        $this->left = $child;
    }

    public function setRight(TreeNode $child) {
        $this->right = $child;
    }
}


class Tree {
    public $root = null;
    public $result = [];

    public function __construct(TreeNode $root) {
        $this->root = $root;
    }

    public function traverse(
        TreeNode $node,
        $level = 0
    ) {
        if ($node) {
            echo str_repeat('-', $level) . $node->data . PHP_EOL;

            foreach ($node->children as $child) {
                $this->traverse($child, $level + 1);
            }
        }
    }

    public function bfs(TreeNode $root) {
        $result   = array();
        $result[] = $root->data;
        $children = $root->children;
        $temp     = [];

        while (!empty($children)) {
            foreach ($children as $childNode) {
                $result[] = $childNode->data;
                if (!empty($childNode)) {
                    foreach ($childNode->children as $child) {
                        $temp[] = $child;
                    }
                }
            }
            $children = $temp;
            $temp     = [];
        }
        print_r($result);
        echo PHP_EOL;
    }

    public function dfs(TreeNode $root) {
        $result = array();
        $stack  = new SplStack();
        $stack->push($root);

        while ($stack->count() > 0) {
            $current           = $stack->pop();
            $result[]          = $current->data;
            $current->children = array_reverse($current->children);
            foreach ($current->children as $childNode) {
                $stack->push($childNode);
            }
        }
        print_r($result);
        echo PHP_EOL;
    }

    public function dfsRecursive(TreeNode $node) {
        $this->result[] = $node->data;

        if (!empty($node->children)) {
            $node->children = array_reverse($node->children);
            foreach ($node->children as $child) {
                $this->dfsRecursive($child);
            }
        }
        return true;
    }
}

function hasSubTree(
    $root1,
    $root2
) {
    if ($root1 == null) {
        return false;
    }

    if ($root2 == null) {
        return true;
    }

    $result = false;
    if ($root1->data == $root2->data) {
        $result = checkSubTree($root1, $root2);
    }
    if (!$result) {
        $result = hasSubTree($root1->left, $root2);
    }

    if (!$result) {
        $result = hasSubTree($root1->right, $root2);
    }

    return $result;
}

function checkSubTree(
    $root1,
    $root2
) {
    if ($root2 == null) {
        return true;
    }

    if ($root1 == null) {
        return false;
    }

    if ($root1->data != $root2->data) {
        return false;
    }
    return checkSubTree($root1->left, $root2->left) && checkSubTree($root1->right, $root2->right);
}

$root   = new TreeNode(0);
$child1 = new TreeNode(1);
$root->add($child1);
$root->setLeft($child1);
$child2 = new TreeNode(2);
$child3 = new TreeNode(3);
$child1->add($child2);
$child1->add($child3);
$child1->setLeft($child2);
$child1->setRight($child3);
$child4 = new TreeNode(4);
$child2->add($child4);
$child2->setLeft($child4);
$tree = new Tree($root);


$subRoot   = new TreeNode(1);
$subChild1 = new TreeNode(2);
$subChild2 = new TreeNode(3);
$subRoot->add($subChild1);
$subRoot->add($subChild2);
$subRoot->setLeft($subChild1);
$subRoot->setRight($subChild2);
$subTree = new Tree($subRoot);

var_dump(hasSubTree($root, $subRoot));