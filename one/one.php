<?php

/**
* Parse students list
*/
class Students implements ArrayAccess, IteratorAggregate
{
	private $students;

	public function __construct( $filename )
	{
		$this->parseFile( file( $filename ) );
	}

	private function parseFile( $file_lines )
	{
		$students_list = array();
		foreach ($file_lines as $line ) 
		{
			$student_data = explode( ',', rtrim( $line ) );
			$name = array_shift( $student_data );
			$students_list[ implode( $student_data ) ][] = $name;
		}
		array_walk( $students_list, function( &$value, $key ){ sort( $value ); } );

		$this->students = $students_list;
	}

	public function offsetExists( $offset )
	{
		return isset( $this->students[$offset] );
	}

	public function offsetGet( $offset )
	{
		return $this->students[$offset];
	}

	public function offsetSet( $offset, $value )
	{
		$this->students[$offset] = $value;
	}

	public function offsetUnset( $offset )
	{
		unset( $this->students[$offset] );
	}

	public function getIterator() {
        return new ArrayIterator($this->students);
    }
}

/**
* Student matcher
*/
class StudentMatcher
{
	private $students_list;

	public function __construct( $students_list )
	{
		$this->students_list = $students_list;
	}

	public function getMatches( $gender, $age, $education, $academic_year )
	{
		$key = implode( array( $gender, $age, $education, $academic_year ) );

		if ( isset( $key, $this->students_list[$key] ) ) 
		{
			return $this->students_list[$key];
		}
		else
		{
			return array( 'NONE' );
		}
	}
}

/**
* Detecting anonymous
*/
class StudentsDetector
{
	public function run( $students_file, $survey_results )
	{
		$students = new Students( $students_file );
		$matcher = new StudentMatcher( $students );

		foreach ( $survey_results as $key => $result ) 
		{
			$case = $key + 1;
			echo "Case #$case: ";
			echo( implode( ',', $matcher->getMatches( $result[0], $result[1], $result[2], $result[3] ) ) ) . PHP_EOL;
		}

	}
}

function parseInput()
{
	fscanf(STDIN, "%d\n", $cases );
	$result = array();
	$i = 0;
	while ( $i++ < $cases ) 
	{
		$line = trim(fgets(STDIN) );
		$result[] = explode( ',', $line );
	}

	return $result;
}

$survey_results = parseInput();

$detector = new StudentsDetector();
$detector->run( 'students', $survey_results );