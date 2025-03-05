<?php

namespace App\Helpers\Table\Traits;

trait WithTable
{
  // public string $actionButtonClass = " flex gap-2 font-bold p-1 px-2 rounded";
  public string $printButtonClass = "text-dark-500 hover:text-dark-700 hover:bg-dark-100 flex gap-2 font-bold p-1 px-2 rounded";
  public string $editButtonClass = "text-cyan-500 hover:text-cyan-700 hover:bg-cyan-100 flex gap-2 font-bold p-1 px-2 rounded";
  public string $showButtonClass = "text-slate-500 hover:text-slate-700 hover:bg-slate-100 flex gap-2 font-bold p-1 px-2 rounded";
  public string $deleteButtonClass = "text-red-500 hover:text-red-700 hover:bg-red-100 flex gap-2 font-bold p-1 px-2 rounded";
  public string $aClass = "text-blue-600 hover:text-blue-800 visited:text-purple-600";
}
